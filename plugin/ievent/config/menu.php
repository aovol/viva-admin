<?php

return [
    [
        'name' => '活动管理',
        'path' => '/content/event',
        'icon' => 'event',
        'slug' => 'event',
        'children' => [
            [
                'name' => '活动列表',
                'path' => '/content/event/list',
                'icon' => 'event',
                'component' => '/content/event/index',
                'slug' => 'event-list',
            ],
            [
                'name' => '活动分类',
                'path' => '/content/event/category',
                'icon' => 'category',
                'component' => '/content/event/category/index',
                'slug' => 'event-category',
            ],
            [
                'name' => '活动标签',
                'path' => '/content/event/tag',
                'icon' => 'tag',
                'component' => '/content/event/tag/index',
                'slug' => 'event-tag',
            ],
            [
                'name' => '活动报名',
                'path' => '/content/event/enroll',
                'icon' => 'enroll',
                'component' => '/content/event/enroll/index',
                'slug' => 'event-enroll',
            ],
            [
                'name' => '活动报名列表',
                'path' => '/content/event/enroll/list',
                'icon' => 'enroll-list',
                'component' => '/content/event/enroll/list/index',
                'slug' => 'event-enroll-list',
            ],
            [
                'name' => '活动报名审核',
                'path' => '/content/event/enroll/audit',
                'icon' => 'enroll-audit',
                'component' => '/content/event/enroll/audit/index',
                'slug' => 'event-enroll-audit',
            ],
            [
                'name' => '活动报名审核列表',
                'path' => '/content/event/enroll/audit/list',
                'icon' => 'enroll-audit-list',
                'component' => '/content/event/enroll/audit/list/index',
                'slug' => 'event-enroll-audit-list',
            ],
        ],
    ],
];
