<?php

namespace app\model;

use support\Model;

class User extends Model
{
    protected $fillable = [
        'username',
        'password',
    ];
}
