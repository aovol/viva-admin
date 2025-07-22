<?php

namespace plugin\admin\app\model;

use support\Model;

class AdminLog extends Model
{
    protected $fillable = [
        'admin_id',
        'type',
        'ip',
        'user_agent',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
