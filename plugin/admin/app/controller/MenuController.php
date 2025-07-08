<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Menu;
use app\controller\BaseController;
use plugin\admin\resource\MenuResource;

class MenuController extends BaseController
{
    public function index(Request $request)
    {
        $menus = Menu::get()->toTree();
        return $this->success(MenuResource::collection($menus));
    }

    /**
     * 创建菜单
     * @param Request $request
     * @return \support\Response
     */
    public function create(Request $request)
    {
        $validator = validator($request->post(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menu,slug',
            'path' => 'required|string|max:255',
        ], [
            'name.required' => '菜单名称不能为空',
            'slug.required' => '菜单别名不能为空',
            'slug.unique' => '菜单别名已存在',
            'path.required' => '菜单路径不能为空',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        $menu = Menu::create($request->post());
        return $this->success($menu, '菜单创建成功');
    }

    public function update(Request $request)
    {
        $menu = Menu::find($request->post('id'));
        $menu->update($request->post());
        return $this->success($menu, '菜单更新成功');
    }
}
