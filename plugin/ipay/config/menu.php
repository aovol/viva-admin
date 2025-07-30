<?php

return [
    [
        'name' => '支付管理',
        'path' => '/ipay',
        'icon' => 'pay',
        'slug' => 'ipay',
        'children' => [
            [
                'name' => '订单列表',
                'path' => '/ipay/order',
                'icon' => 'order',
                'component' => '/ipay/order/index',
                'slug' => 'ipay-order',
            ],
            [
                'name' => '通道类型',
                'path' => '/ipay/channel/type',
                'icon' => 'type',
                'component' => '/ipay/channel/type/index',
                'slug' => 'ipay-channel-type',
            ],
            [
                'name' => '通道管理',
                'path' => '/ipay/channel/list',
                'icon' => 'channel',
                'component' => '/ipay/channel/index',
                'slug' => 'ipay-channel-list',
            ],
            [
                'name' => '设置',
                'path' => '/ipay/setting',
                'icon' => 'setting',
                'component' => '/ipay/setting/index',
                'slug' => 'ipay-setting',
            ],
        ],
    ],
];
