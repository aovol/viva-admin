<?php

namespace plugin\admin\app\common\controller\system;

use support\Request;
use plugin\admin\app\common\model\system\Role;
use plugin\admin\resource\RoleResource;
use Casbin\WebmanPermission\Permission;
use plugin\admin\app\common\model\system\Node;
use support\Db;
use plugin\admin\app\controller\BaseController;

class RoleController extends BaseController
{
    public function index(Request $request)
    {
        $role = Role::query();
        if ($request->get('fetchAll')) {
            $roles = $role->get();
            return $this->success(RoleResource::collection($roles));
        }
        $roles = $role->paginate();
        return $this->success([
            'items' => RoleResource::collection($roles->items()),
            'total' => $roles->total(),
            'page' => $roles->currentPage(),
            'limit' => $roles->perPage(),
        ]);
    }

    public function create(Request $request)
    {
        $v = validator($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:roles,slug',
        ], [
            'name.required' => '请输入角色名称',
            'name.string' => '角色名称必须是字符串',
            'slug.required' => '请输入角色标识',
            'slug.string' => '角色标识必须是字符串',
            'slug.unique' => '角色标识已存在',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first(), 422);
        }
        $role = Role::create($request->all());
        return $this->message('创建角色成功');
    }

    public function update(Request $request)
    {
        $data = $request->post();
        $v = validator($data, [
            'id' => 'required|integer',
            'name' => 'required|string',
            'slug' => 'required|string|unique:roles,slug,' . $data['id'],
        ], [
            'name.required' => '请输入角色名称',
            'name.string' => '角色名称必须是字符串',
            'slug.required' => '请输入角色标识',
            'id.required' => '角色ID不能为空',
            'id.integer' => '角色ID必须是整数',
            'slug.unique' => '角色标识已存在',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first(), 422);
        }
        Db::beginTransaction();
        try {
            $role = Role::find($data['id']);
            if (!$role) {
                return $this->error('角色不存在', 404);
            }
            $role->name = $data['name'];
            $role->slug = $data['slug'];
            if ($data['node_ids']) {
                $nodeIds = $data['node_ids'];
                foreach ($nodeIds as $id) {
                    $node = Node::where([
                        'id' => $id,
                        'type' => 'permission',
                    ])->first();
                    if (!$node) {
                        continue;
                    }
                    Permission::addPolicy($role->slug, $node->api, $node->method);
                }
            }
            $role->save();
            Db::commit();
            return $this->message('更新角色成功');
        } catch (\Throwable $th) {
            Db::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $role = Role::find($request->post('id'));
        if (!$role) {
            return $this->error('角色不存在', 404);
        }
        $role->delete();
        return $this->message('删除已角色');
    }
}
