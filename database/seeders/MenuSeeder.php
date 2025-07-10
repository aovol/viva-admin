<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use plugin\admin\app\model\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => '仪表盘',
                'slug' => 'dashboard',
                'icon' => 'dashboard',
                'path' => '/dashboard',
                'redirect' => '/dashboard/index',
                'children' => [
                    [
                        'name' => '概览',
                        'slug' => 'dashboard-index',
                        'icon' => 'dashboard',
                        'path' => '/dashboard/index',
                        'component' => '/dashboard/index',
                    ],
                    [
                        'name' => '统计',
                        'slug' => 'dashboard-statistics',
                        'icon' => 'dashboard',
                        'path' => '/dashboard/statistics',
                        'component' => '/dashboard/statistics',
                    ]
                ]
            ],
            [
                'name' => '内容管理',
                'slug' => 'content',
                'icon' => 'content',
                'path' => '/content',
                'component' => '',
                'redirect' => '/content/article',
                'children' => [
                    [
                        'name' => '文章',
                        'slug' => 'content-article',
                        'icon' => 'article',
                        'path' => '/content/article',
                        'component' => '/content/article/index',
                    ],
                    [
                        'name' => '栏目',
                        'slug' => 'content-category',
                        'icon' => 'category',
                        'path' => '/content/category',
                        'component' => '/content/category/index',
                    ],
                    [
                        'name' => '标签',
                        'slug' => 'content-tag',
                        'icon' => 'tag',
                        'path' => '/content/tag',
                        'component' => '/content/tag/index',
                    ]
                ]
            ],
            [
                'name' => '系统管理',
                'slug' => 'system',
                'icon' => 'system',
                'path' => '/system',
                'component' => '',
                'redirect' => '/system/menu',
                'children' => [
                    [
                        'name' => '菜单管理',
                        'slug' => 'system-menu',
                        'icon' => 'menu',
                        'path' => '/system/menu',
                        'component' => '/system/menu/index',
                    ],
                    [
                        'name' => '设置',
                        'slug' => 'system-setting',
                        'icon' => 'dashboard',
                        'path' => '/system/setting',
                        'component' => '/system/setting/index',
                    ],
                    [
                        'name' => '角色权限',
                        'slug' => 'system-role',
                        'icon' => 'role',
                        'path' => '/system/role',
                        'component' => '/system/role/index',
                    ],
                    [
                        'name' => '管理员',
                        'slug' => 'system-admin',
                        'icon' => 'admin',
                        'path' => '/system/admin',
                        'component' => '/system/admin/index',
                    ]
                ]
            ]
        ];
        foreach ($menus as $menuItem) {
            $menu = Menu::create([
                'name' => $menuItem['name'],
                'slug' => $menuItem['slug'],
                'icon' => $menuItem['icon'],
                'path' => $menuItem['path'],
                'component' => $menuItem['component'] ?? '',
                'redirect' => $menuItem['redirect'],
                'parent_id' => 0,
            ]);
            // var_dump($menu);
            if (isset($menuItem['children'])) {
                foreach ($menuItem['children'] as $child) {
                    Menu::create([
                        'name' => $child['name'],
                        'slug' => $child['slug'],
                        'icon' => $child['icon'],
                        'path' => $child['path'],
                        'component' => $child['component'] ?? '',
                        'parent_id' => $menu->id,
                    ]);
                }
            }
        }
    }
}
