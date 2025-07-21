<?php

namespace plugin\admin\app\common\model\system;

use Aovol\WebmanAuth\Model\AuthModelInterface;
use support\Model;

class Admin extends Model implements AuthModelInterface
{
    protected $fillable = ['name', 'password', 'status', 'last_login_id'];
    protected $hidden = ['password'];

    public function findUser($username)
    {
        return $this->where('name', $username)->first();
    }
}
