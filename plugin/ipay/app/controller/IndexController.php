<?php

namespace plugin\ipay\app\controller;

use plugin\admin\app\controller\BaseController;
use support\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {
        return view('index/index', ['name' => 'ipay']);
    }

}
