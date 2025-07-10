<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Menu;
use app\controller\BaseController;
use plugin\admin\resource\MenuResource;

class RoleController extends BaseController
{
    public function index(Request $request)
    {
        $roles = Role::all();
        return $this->success($roles);
    }
}
