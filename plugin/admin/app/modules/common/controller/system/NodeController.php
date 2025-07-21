<?php

namespace plugin\admin\app\common\controller\system;

use support\Request;
use plugin\admin\app\common\model\system\Node;
use plugin\admin\resource\NodeResource;
use WebmanTech\LaravelValidation\Facades\Validator;
use Illuminate\Validation\Rule;
use Casbin\WebmanPermission\Permission;
use Aovol\WebmanAuth\Facade\Auth;
use plugin\admin\app\controller\BaseController;

class NodeController extends BaseController
{
    public function index(Request $request)
    {
        Node::fixTree();

        $w = [];
        $type = $request->get('type');
        if ($type) {
            $w['type'] = $type;
        }
        $nodes = Node::where($w)->orderBy('sort', 'desc')->get()->toTree();

        return $this->success(NodeResource::collection($nodes));
    }

    /**
     * 创建菜单
     * @param Request $request
     * @return \support\Response
     */
    public function create(Request $request)
    {
        $data = $request->post();
        $data['parent_id'] = $data['parent_id'] ?? 0;
        $validator = Validator::make($data, [
            'name' => [
                Rule::requiredIf($data['type'] == 'menu' || ($data['type'] == 'permission' && $data['create_type'] == 'single')),
            ],
            'path' => [
                Rule::requiredIf($data['type'] == 'menu' || ($data['type'] == 'permission' && $data['create_type'] == 'single')),
                'unique:nodes,path',
            ],
            'method' => Rule::requiredIf($data['type'] == 'permission' && $data['create_type'] == 'single'),
            'batch_permissions' => Rule::requiredIf($data['type'] == 'permission' && $data['create_type'] == 'batch'),
        ], [
            'name.required' => '请输入节点名称',
            'path.required' => '请输入节点唯一标识',
            'path.unique' => $data['type'] == 'menu' ? '路由已存在' : '权限标识已存在',
            'method.required' => '请选择请求方法',
            'batch_permissions.required' => '请输入批量添加的节点',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        if ($request->post('create_type') === 'single') {
            if ($data['method']) {
                $data['method'] = strtoupper($data['method']);
            }
            Node::create($data);
        } else {
            $permissions = explode("\n", $data['batch_permissions']);
            foreach ($permissions as $permission) {
                $permission = explode('|', $permission);
                if (count($permission) < 3) {
                    return $this->error('批量添加的节点格式不正确');
                }
                //验证unique:nodes,path
                if (Node::where('path', $permission[1])->exists()) {
                    return $this->error('节点唯一标识已存在：' . $permission[1]);
                }
                Node::create([
                    'name' => $permission[0],
                    'path' => $permission[1],
                    'method' => strtoupper($permission[2]),
                    'type' => 'permission',
                    'parent_id' => $data['parent_id'] ?? 0,
                ]);
            }
        }
        return $this->message('节点创建成功');
    }

    public function update(Request $request)
    {
        $data = $request->post();
        $node = Node::find($data['id']);

        if ($data['method']) {
            $data['method'] = strtoupper($data['method']);
        }
        $user = Auth::guard('admin')->user();
        $roles = Permission::getRolesForUser('admin_' . $user->id);
        //更新权限
        foreach ($roles as $role) {
            $api = $data['api'] ?? $node->api;
            $method = $data['method'] ?? $node->method;
            if ($api && $api !== $node->api) {
                Permission::updatePolicy([$role, $node->api, $node->method], [
                    $role, $api, $method
                ]);
            }
        }

        $node->update($data);

        return $this->success($node, '节点更新成功');
    }

    public function delete(Request $request)
    {
        $node = Node::query()->withCount('children')->find($request->post('nodeId'));
        if ($node->children_count > 0) {
            return $this->error('节点下有子节点，不能删除');
        }
        $node->delete();
        return $this->success(null, '节点删除成功');
    }
}
