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
                        'component' => 'system/menu/index',
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
                'component' => $menuItem['component'],
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
                        'component' => $child['component'],
                        'parent_id' => $menu->id,
                    ]);
                }
            }
        }
    }
}
