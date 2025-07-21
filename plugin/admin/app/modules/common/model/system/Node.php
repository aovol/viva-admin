<?php

namespace plugin\admin\app\common\model\system;

use support\Model;
use Kalnoy\Nestedset\NodeTrait;

class Node extends Model
{
    use NodeTrait;

    protected $fillable = [
        'name',
        'parent_id',
        'path',
        'api',
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
        'method',
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
