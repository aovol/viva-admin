<?php

namespace plugin\admin\app\common\model\system;

use support\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
}
