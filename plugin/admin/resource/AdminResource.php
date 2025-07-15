<?php

namespace plugin\admin\resource;

use WebmanResource\JsonResource;
use Carbon\Carbon;

class AdminResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
