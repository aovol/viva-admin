<?php

namespace plugin\admin\resource;

use WebmanResource\JsonResource;
use plugin\admin\app\model\Admin;
use Carbon\Carbon;

class AdminResource extends JsonResource
{
    public $model = Admin::class;

    public function toArray($request = null): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
