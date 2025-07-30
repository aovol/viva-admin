<?php

namespace plugin\ipay\app\model;

use plugin\admin\app\model\BaseModel;

class PayOrder extends BaseModel
{
    protected $fillable = [
        'order_no',
        'order_amount',
        'order_status',
        'order_type',
        'order_time',
        'order_time',
    ];
}
