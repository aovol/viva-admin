<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use plugin\admin\app\model\Node;

class NodeSeeder extends AbstractSeed
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
                'path' => '/dashboard',
                'redirect' => '/dashboard/index',
                'icon' => 'dashboard',
                'children' => [
                    [
                        'name' => '概览',
                        'path' => '/dashboard/index',
                        'component' => '/dashboard/index',
                        'icon' => 'dashboard',
                    ],
                    [
                        'name' => '统计',
                        'path' => '/dashboard/statistics',
                        'component' => '/dashboard/statistics',
                        'icon' => 'dashboard',
                    ],
                ],
            ],
            [
                'name' => '系统管理',
                'path' => '/system',
                'redirect' => '/system/node',
                'icon' => 'dashboard',
                'children' => [
                    [
                        'name' => '节点',
                        'path' => '/system/node',
                        'component' => '/system/node/index',
                        'icon' => 'menu',
                        'children' => [
                            [
                                'name' => '查看节点',
                                'path' => '/system/node/index',
                                'type' => 'permission',
                                'method' => 'GET',
                            ],
                            [
                                'name' => '创建节点',
                                'path' => '/system/node/create',
                                'type' => 'permission',
                                'method' => 'POST',
                            ],
                            [
                                'name' => '更新节点',
                                'path' => '/system/node/update',
                                'type' => 'permission',
                                'method' => 'PUT',
                            ],
                            [
                                'name' => '删除节点',
                                'path' => '/system/node/delete',
                                'type' => 'permission',
                                'method' => 'DELETE',
                            ],
                        ],
                    ],
                    [
                        'name' => '角色',
                        'path' => '/system/role',
                        'component' => '/system/role/index',
                        'icon' => 'role',
                        'children' => [
                            [
                                'name' => '查看角色',
                                'path' => '/system/role/index',
                                'type' => 'permission',
                                'method' => 'GET',
                            ],
                            [
                                'name' => '创建角色',
                                'path' => '/system/role/create',
                                'type' => 'permission',
                                'method' => 'POST',
                            ],
                            [
                                'name' => '更新角色',
                                'path' => '/system/role/update',
                                'type' => 'permission',
                                'method' => 'PUT',
                            ],
                            [
                                'name' => '删除角色',
                                'path' => '/system/role/delete',
                                'type' => 'permission',
                                'method' => 'DELETE',
                            ],
                        ],
                    ],
                    [
                        'name' => '管理员',
                        'path' => '/system/admin',
                        'component' => '/system/admin/index',
                        'icon' => 'admin',
                        'children' => [
                            [
                                'name' => '查看管理员',
                                'path' => '/system/admin/index',
                                'type' => 'permission',
                                'method' => 'GET',
                            ],
                            [
                                'name' => '创建管理员',
                                'path' => '/system/admin/create',
                                'type' => 'permission',
                                'method' => 'POST',
                            ],
                            [
                                'name' => '更新管理员',
                                'path' => '/system/admin/update',
                                'type' => 'permission',
                                'method' => 'PUT',
                            ],
                            [
                                'name' => '删除管理员',
                                'path' => '/system/admin/delete',
                                'type' => 'permission',
                                'method' => 'DELETE',
                            ],
                        ],
                    ],
                ],
            ],
        ];
        foreach ($menuItems as $menuItem) {
            $menu = Node::create($menuItem);
            // if (isset($menuItem['children'])) {
            //     foreach ($menuItem['children'] as $child) {
            //         $child['parent_id'] = $menu->id;
            //         $child = Menu::create($child);
            //     }
            // }
        }
    }
}
