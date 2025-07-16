<?php

namespace plugin\admin\app\model;

use support\Model;
use Kalnoy\Nestedset\NodeTrait;

class Node extends Model
{
    use NodeTrait;

    protected $fillable = [
        'name',
        'guard_name',
        'slug',
        'parent_id',
        'path',
        'component',
        'redirect',
        'icon',
        'sort',
        'lft',
        'rgt',
        'status',
        'type',
        'is_show',
        'show_page_head',
    ];

    public function getLftName()
    {
        return 'lft';
    }

    public function getRgtName()
    {
        return 'rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }
}
