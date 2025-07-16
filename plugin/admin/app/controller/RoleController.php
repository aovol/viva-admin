<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Role;
use plugin\admin\resource\RoleResource;

class RoleController extends BaseController
{
    public function index(Request $request)
    {
        $guard = $request->input('guard_name', 'admin');
        $roles = Role::query()->where('guard_name', $guard)->paginate();
        return $this->success([
            'guard_name' => $guard,
            'items' => RoleResource::collection($roles->items()),
            'total' => $roles->total(),
            'page' => $roles->currentPage(),
            'limit' => $roles->perPage(),
        ]);
    }

    public function create(Request $request)
    {
        $v = validator($request->all(), [
            'guard_name' => 'required|string',
            'name' => 'required|string',
            'slug' => 'required|string|unique:roles,slug',
        ], [
            'name.required' => '请输入角色名称',
            'name.string' => '角色名称必须是字符串',
            'guard_name.required' => '请选择角色类型',
            'guard_name.string' => '角色类型必须是字符串',
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
        $v = validator($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string',
            'slug' => 'required|string|unique:roles,slug,' . $request->post('id'),
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
        $role = Role::find($request->post('id'));
        if (!$role) {
            return $this->error('角色不存在', 404);
        }
        $role->update($request->all());
        return $this->message('更新角色成功');
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
