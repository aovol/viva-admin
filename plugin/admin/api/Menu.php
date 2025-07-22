<?php

namespace plugin\admin\api;

class Menu
{
    /**
     * 导入菜单
     * @param array $menu_tree
     * @return void
     */
    public static function import(array $menus, $parent = 'root')
    {
        if (is_numeric(key($menu_tree)) && !isset($menu_tree['key'])) {
            foreach ($menu_tree as $item) {
                static::import($item);
            }
            return;
        }
        $children = $menu_tree['children'] ?? [];
        unset($menu_tree['children']);
        if ($old_menu = Menu::get($menu_tree['key'])) {
            $pid = $old_menu['id'];
            Rule::where('key', $menu_tree['key'])->update($menu_tree);
        } else {
            $pid = static::add($menu_tree);
        }
        foreach ($children as $menu) {
            $menu['pid'] = $pid;
            static::import($menu);
        }
    }
}
