<?php

namespace plugin\ipay\app\model;

use plugin\admin\app\model\BaseModel;

class PayChannelType extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
        'icon',
        'status',
    ];
}
