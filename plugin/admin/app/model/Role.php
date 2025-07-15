<?php

namespace plugin\admin\app\model;

use support\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'guard_name',
    ];


}
