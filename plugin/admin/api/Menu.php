<?php

namespace plugin\admin\api;

use plugin\admin\app\model\Node;

class Menu
{
    /**
     * 导入菜单
     * @param array $menu_tree
     * @return void
     */
    public static function import(array $menus, $parent = 'root')
    {
        foreach ($menus as $menu) {
            if ($parent === 'root') {
                $node = Node::create($menu);
            } else {
                $parent_node = Node::where('slug', $parent)->first();
                if ($parent_node) {
                    $menu['parent_id'] = $parent_node->id;
                    Node::create($menu, $parent_node);
                }
            }
        }
    }

    /**
     * 删除菜单
     * @param string $slug
     * @return void
     */
    public static function delete(string $slug)
    {
        $node = Node::where('slug', $slug)->first();
        if ($node) {
            $node->delete();
        }
    }
}
