<?php

namespace plugin\admin\resource;

use WebmanResource\JsonResource;
use Carbon\Carbon;

class RoleResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'slug' => $this->slug,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
