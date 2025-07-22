<?php

return [
    'enable' => true,
    'defaults' => [
        'guard' => 'user',
    ],
    'guards' => [
        'user' => [
            'model' => 'User',
            'driver' => 'jwt',
            'username' => 'username',
        ],
        'admin' => [
            'model' => plugin\admin\app\model\Admin::class,
            'driver' => 'jwt',
            'username' => 'username',
        ]
    ],
];
