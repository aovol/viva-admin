<?php

namespace plugin\ipay\app\model;

use plugin\admin\app\model\BaseModel;

class PayChannelType extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
        'icon',
        'status',
        'parent_id',
    ];

    /**
         * 获取树形菜单
         * @param int $parentId 父级ID
         * @return array
         */
    public static function getTree($parentId = 0)
    {
        // 获取所有菜单
        $allMenus = self::all()->toArray();

        // 构建树形结构
        return self::buildTree($allMenus, $parentId);
    }

    /**
     * 构建树形结构
     * @param array $elements 所有元素
     * @param int $parentId 父级ID
     * @return array
     */
    protected static function buildTree(array $elements, $parentId = 0)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);

                if ($children) {
                    $element['children'] = $children;
                }

                $branch[] = $element;
            }
        }

        return $branch;
    }
}
