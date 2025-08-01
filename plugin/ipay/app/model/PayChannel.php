<?php

namespace plugin\ipay\app\model;

use plugin\admin\app\model\BaseModel;

class PayChannel extends BaseModel
{
    protected $table = 'pay_channels';

    protected $fillable = [
        'name',
        'code',
        'type_code',
        'app_id',
        'public_key',
        'private_key',
        'notify_url',
        'return_url',
        'sort',
        'is_show',
        'is_default',
        'status',
    ];

    public function type()
    {
        return $this->belongsTo(PayChannelType::class, 'type_code', 'code');
    }
}
