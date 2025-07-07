<?php

namespace plugin\admin\app\controller;

use support\Request;

class AuthController
{
    public function login(Request $request)
    {
        return json(['code' => 0, 'msg' => 'success']);
    }

    public function logout(Request $request)
    {
        return 'logout';
    }
}
