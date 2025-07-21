<?php

use plugin\admin\app\event\AdminEvent;

return [
    'admin.login' => [
        [AdminEvent::class, 'login'],
    ],
];
