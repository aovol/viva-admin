<?php

namespace plugin\admin\app\controller;

use support\Request;
use plugin\admin\app\model\Menu;
use plugin\admin\resource\MenuResource;
use plugin\admin\app\model\Permission;
use plugin\admin\resource\PermissionResource;
use plugin\admin\app\model\PermissionGroup;

class PermissionController extends BaseController
{
    public function index(Request $request)
    {
        $permissions = Permission::all();
        $permissions = PermissionResource::collection($permissions);
        return $this->success($permissions);
    }

    public function create(Request $request)
    {
        $validator = validate($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'group_id' => 'required|integer|exists:permission_groups,id',
        ], [
            'name.required' => '请输入权限名称',
            'name.string' => '权限名称必须是字符串',
            'name.max' => '权限名称不能超过255个字符',
            'slug.required' => '请输入权限标识',
            'slug.string' => '权限标识必须是字符串',
            'slug.max' => '权限标识不能超过255个字符',
            'group_id.required' => '请选择权限组',
            'group_id.integer' => '权限组必须是整数',
            'group_id.exists' => '权限组不存在',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        $permission = Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'group_id' => $request->input('group_id'),
        ]);
        return $this->message('创建成功');
    }

    public function update(Request $request)
    {
        return $this->message('更新成功');
    }

    public function delete(Request $request)
    {
        return $this->message('删除成功');
    }


    /**
     * 获取所有控制器
     */
    public function controllers()
    {
        //获取所有控制器
        $controllers = glob(config('plugin.admin.app.controllers_path') . '/*.php');
        $controllers = array_map(function ($controller) {
            return basename($controller, '.php');
        }, $controllers);
        $controllers = array_filter($controllers, function ($controller) {
            return !in_array($controller, ['BaseController']);
        });
        //获取所有控制器方法
        $methods = [];
        foreach ($controllers as $controller) {
            // 构建完整的类名
            $className = "\\plugin\\admin\\app\\controller\\{$controller}";
            if (class_exists($className)) {
                // 获取所有方法
                $allMethods = get_class_methods($className);

                // 过滤掉不需要的方法
                $filteredMethods = array_filter($allMethods, function ($method) {
                    return !in_array($method, ['__construct', 'initialize', 'validate', 'success', 'error', 'message']);
                });

                $methods[$controller] = array_values($filteredMethods); // 重新索引数组
            }
        }
        return $this->success([
            'admin' => $methods,
        ]);
    }

    public function groups()
    {
        $groups = PermissionGroup::all();
        return $this->success($groups);
    }
}
