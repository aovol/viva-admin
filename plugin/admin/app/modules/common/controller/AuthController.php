<?php

namespace plugin\admin\app\controller;

use support\Request;
use Aovol\WebmanAuth\Facade\Auth;
use plugin\admin\resource\AdminResource;
use Webman\Event\Event;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        try {
            $result = Auth::guard('admin')->login($request->post());
            Event::dispatch('admin.login', $result['user']);
            return $this->success($result['token']);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        return $this->success();
    }

    public function user(Request $request)
    {
        $user = Auth::guard('admin')->user();
        return $this->success(new AdminResource($user));
    }
}
