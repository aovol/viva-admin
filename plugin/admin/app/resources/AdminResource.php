<?php

namespace plugin\admin\app\resources;

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
            'name' => $this->name,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
