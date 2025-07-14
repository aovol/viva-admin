<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Menu;
use plugin\admin\app\resources\MenuResource;

class RoleController extends BaseController
{
    public function index(Request $request)
    {
        $roles = Role::all();
        return $this->success($roles);
    }

    public function create(Request $request)
    {
        return $this->success(null, '创建角色');
    }

    public function update(Request $request)
    {
        return $this->success(null, '更新角色');
    }

    public function delete(Request $request)
    {
        return $this->success(null, '删除角色');
    }
}
