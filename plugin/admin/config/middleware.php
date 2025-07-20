<?php

namespace plugin\admin\config;

use plugin\admin\app\middleware\PermissionMiddleware;

return [
    'plugin.admin' => [
        'permission' => PermissionMiddleware::class,
    ],
];
