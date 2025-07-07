<?php

namespace app\admin\controller;

use app\controller\BaseController;
use Aovol\Easyauth\facade\Auth;
use Aovol\Demo\Demo;

class AuthController extends BaseController
{
    public function login()
    {
        $demo = new Demo();
        return $demo->test();

        $credentials = $this->request->post();
        //         return json($credentials);
        $user = Auth::login($credentials);
        return json($user);
        //        if (!$user) {
        //            return json(['code' => 1, 'msg' => '登录失败']);
        //        }
        //        return json(['code' => 0, 'msg' => 'ok', 'data' => $token]);
    }
}
