<?php

namespace plugin\admin\app\model;

use Aovol\WebmanAuth\Model\AuthModelInterface;
use support\Model;

class Admin extends Model implements AuthModelInterface
{
    protected $hidden = ['password'];

    public function findUser($username)
    {
        return $this->where('username', 'admin')->first();
    }
}
