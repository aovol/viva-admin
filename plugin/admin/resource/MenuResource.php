<?php

namespace plugin\admin\resource;

use WebmanResource\JsonResource;
use Carbon\Carbon;

class MenuResource extends JsonResource
{
    public function toArray($request = null): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'path' => $this->path,
            'component' => $this->component,
            'redirect' => $this->redirect,
            'hidden' => (bool) $this->hidden,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'status' => (bool) $this->status,
            'show_page_head' => (bool) $this->show_page_head,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->toDateTimeString() : null,
        ];
        if ($this->children) {
            $data['children'] = MenuResource::collection($this->children);
        }
        return $data;
    }
}
