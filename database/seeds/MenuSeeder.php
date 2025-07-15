<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use plugin\admin\app\model\Menu;

class MenuSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $menuItems = [
            [
                'name' => '仪表盘',
                'slug' => 'dashboard',
                'path' => '/dashboard',
                'redirect' => '/dashboard/index',
                'icon' => 'dashboard',
                'children' => [
                    [
                        'name' => '概览',
                        'slug' => 'dashboard-index',
                        'path' => '/dashboard/index',
                        'component' => '/dashboard/index',
                        'icon' => 'dashboard',
                    ],
                    [
                        'name' => '统计',
                        'slug' => 'dashboard-statistics',
                        'path' => '/dashboard/statistics',
                        'component' => '/dashboard/statistics',
                        'icon' => 'dashboard',
                    ],
                ],
            ],
            [
                'name' => '系统管理',
                'slug' => 'system',
                'path' => '/system',
                'redirect' => '/system/menu',
                'icon' => 'dashboard',
                'children' => [
                    [
                        'name' => '菜单',
                        'slug' => 'system-menu',
                        'path' => '/system/menu',
                        'component' => '/system/menu/index',
                        'icon' => 'menu',
                    ],
                    [
                        'name' => '角色',
                        'slug' => 'system-role',
                        'path' => '/system/role',
                        'component' => '/system/role/index',
                        'icon' => 'role',
                    ],
                    [
                        'name' => '权限',
                        'slug' => 'system-permission',
                        'path' => '/system/permission',
                        'component' => '/system/permission/index',
                        'icon' => 'permission',
                    ],
                    [
                        'name' => '管理员',
                        'slug' => 'system-admin',
                        'path' => '/system/admin',
                        'component' => '/system/admin/index',
                        'icon' => 'admin',
                    ],
                ],
            ],
        ];
        foreach ($menuItems as $menuItem) {
            $menu = Menu::create($menuItem);
            // if (isset($menuItem['children'])) {
            //     foreach ($menuItem['children'] as $child) {
            //         $child['parent_id'] = $menu->id;
            //         $child = Menu::create($child);
            //     }
            // }
        }
    }
}
