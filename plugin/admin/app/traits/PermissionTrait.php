<?php

namespace plugin\admin\app\traits;

use Casbin\WebmanPermission\Permission;

trait PermissionTrait
{
    public function hasPermission($permission)
    {
        return Permission::enforce($this->user->id, $permission);
    }
}
