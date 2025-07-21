<?php

namespace plugin\admin\resource;

use WebmanResource\JsonResource;
use plugin\admin\app\model\Node;
use Carbon\Carbon;

class NodeResource extends JsonResource
{
    public $model = Node::class;
    public function toArray($request = null): array
    {
        $data = [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'icon' => $this->icon,
            'path' => $this->path,
            'component' => $this->component,
            'redirect' => $this->redirect,
            'hidden' => (bool) $this->hidden,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'status' => (bool) $this->status,
            'is_show' => (bool) $this->is_show,
            'show_page_head' => (bool) $this->show_page_head,
            'method' => $this->method,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->toDateTimeString() : null,
        ];
        if ($this->children) {
            $data['children'] = NodeResource::collection($this->children);
        }
        return $data;
    }
}
