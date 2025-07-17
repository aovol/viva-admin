<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Node;
use plugin\admin\resource\NodeResource;
use WebmanTech\LaravelValidation\Facades\Validator;

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
            'name' => 'required_if:type,menu|string|max:255',
            'slug' => 'required_if:type,menu|string|max:255|unique:nodes,slug',
            'path' => 'required_if:type,menu|string|max:255',
        ], [
            'name.required_if' => '请输入节点名称',
            'slug.required_if' => '请输入节点别名',
            'slug.unique' => '节点别名已存在',
            'path.required_if' => '请输入节点路径',
        ]);
        $validator->after(function ($validator) use ($data) {
            if ($data['type'] == 'permission' && $data['create_type'] == 'batch' && empty($data['batch_permissions'])) {
                $validator->errors()->add('batch_permissions', '请输入批量添加的节点');
            }
        });
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }



        if ($request->post('create_type') === 'single') {
            Node::create($data);
        } else {
            $permissions = explode("\n", $data['batch_permissions']);
            foreach ($permissions as $permission) {
                $permission = explode('|', $permission);
                Node::create([
                    'name' => $permission[0],
                    'slug' => $permission[1],
                    'api' => $permission[2] ?? '',
                    'type' => 'permission',
                    'parent_id' => $data['parent_id'],
                ]);
            }

        }
        return $this->message('节点创建成功');
    }

    public function update(Request $request)
    {
        $node = Node::find($request->post('id'));
        $node->update($request->post());
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
