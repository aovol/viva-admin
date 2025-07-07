<?php

namespace plugin\admin\app\model;

use support\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;

    protected $fillable = ['name', 'parent_id', 'left', 'right', 'depth'];

    public function getLftName()
    {
        return 'left';
    }

    public function getRgtName()
    {
        return 'right';
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
