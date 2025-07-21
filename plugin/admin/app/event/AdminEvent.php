<?php

namespace plugin\admin\app\event;

use plugin\admin\app\model\system\Admin;
use plugin\admin\app\model\system\AdminLog;

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
