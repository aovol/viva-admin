<?php

namespace plugin\admin\app\event;

use plugin\admin\app\model\Admin;
use plugin\admin\app\model\AdminLog;

class AdminEvent
{
    public function login(Admin $admin)
    {
        AdminLog::create([
            'admin_id' => $admin->id,
            'type' => 'login',
            'ip' => request()->getRealIp(),
            'user_agent' => request()->header('user-agent'),
        ]);

        return $admin;
    }
}
