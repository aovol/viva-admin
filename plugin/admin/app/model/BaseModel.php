<?php

namespace plugin\admin\app\model;

use support\Model;
use DateTimeInterface;

class BaseModel extends Model
{
    public function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
