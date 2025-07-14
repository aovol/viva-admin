<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Menu;
use plugin\admin\app\resources\MenuResource;

class PermissionController extends BaseController
{
    public function index(Request $request)
    {
        return $this->success(null, '权限列表');
    }

    public function create(Request $request)
    {
        return $this->success(null, '创建权限');
    }

    public function update(Request $request)
    {
        return $this->success(null, '更新权限');
    }

    public function delete(Request $request)
    {
        return $this->success(null, '删除权限');
    }
}
