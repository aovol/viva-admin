<?php

namespace plugin\admin\app\model;

use support\Model;
use plugin\admin\app\model\PermissionGroup;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'guard_name',
        'group_name',
        'path',
        'description',
    ];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_name');
    }
}
