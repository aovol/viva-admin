<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Admin;
use plugin\admin\resource\AdminResource;

class AdminController extends BaseController
{
    public function index()
    {
        $admins = Admin::paginate();
        return $this->success([
            'items' => AdminResource::collection($admins->items()),
            'total' => $admins->total(),
            'current_page' => $admins->currentPage(),
            'page_size' => $admins->perPage(),
        ]);
    }

    public function create(Request $request)
    {
        $v = \validator($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed',
        ], [
            'name.required' => '管理员名称不能为空',
            'name.string' => '管理员名称必须是字符串',
            'name.max' => '管理员名称不能超过255个字符',
            'password.required' => '管理员密码不能为空',
            'password.confirmed' => '管理员密码和确认密码不一致',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }
        $admin = Admin::create([
            'name' => $request->post('name'),
            'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            'status' => 1,
        ]);
        return $this->success($admin, '创建成功');
    }

    public function update(Request $request)
    {
        $aId = $request->post('id');
        $password = $request->post('password');
        $admin = Admin::find($aId);
        if (!$admin) {
            return $this->error('管理员不存在');
        }
        $data = [];
        if ($password) {
            if ($password !== $request->post('password_confirmation')) {
                return $this->error('密码和确认密码不一致');
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            $admin->update($data);
        }
        return $this->success($admin, '更新成功');
    }

    public function delete(Request $request)
    {
        $aId = $request->post('id');
        $admin = Admin::find($aId);
        if ($admin->name === 'admin') {
            return $this->error('超级管理员不能删除');
        }
        if (!$admin) {
            return $this->error('管理员不存在');
        }
        $admin->delete();
        return $this->message('删除成功');
    }


}
