<?php

namespace plugin\admin\app\model;

use support\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'path',
        'component',
        'redirect',
        'hidden',
        'lft',
        'rgt',
        'parent_id',
        'permission',
        'sort',
        'status',
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
