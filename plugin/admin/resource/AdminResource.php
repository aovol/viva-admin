<?php

namespace plugin\admin\resource;

use WebmanResource\JsonResource;
use Carbon\Carbon;
use Casbin\WebmanPermission\Permission;

class AdminResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role_slugs' => Permission::getRolesForUser('admin_' . $this->id),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
