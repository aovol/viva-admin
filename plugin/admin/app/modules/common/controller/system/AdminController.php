<?php

namespace plugin\admin\app\common\controller\system;

use support\Request;
use plugin\admin\app\common\model\system\Admin;
use plugin\admin\resource\AdminResource;
use Casbin\WebmanPermission\Permission;
use plugin\admin\app\controller\BaseController;
use support\Db;

class AdminController extends BaseController
{
    public function index()
    {
        $admins = Admin::paginate();
        return $this->success([
            'items' => AdminResource::collection($admins->items()),
            'total' => $admins->total(),
            'current_page' => $admins->currentPage(),
            'page_size' => $admins->perPage(),
        ]);
    }

    public function create(Request $request)
    {
        $v = \validator($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed',
        ], [
            'name.required' => '管理员名称不能为空',
            'name.string' => '管理员名称必须是字符串',
            'name.max' => '管理员名称不能超过255个字符',
            'password.required' => '管理员密码不能为空',
            'password.confirmed' => '管理员密码和确认密码不一致',
        ]);
        if ($v->fails()) {
            return $this->error($v->errors()->first());
        }
        $admin = Admin::create([
            'name' => $request->post('name'),
            'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            'status' => 1,
        ]);
        return $this->success($admin, '创建成功');
    }

    public function update(Request $request)
    {
        //return json(Permission::enforce('admin_1', '/system/node/index', 'GET'));
        Db::beginTransaction();
        try {
            $aId = $request->post('id');
            $password = $request->post('password');
            $admin = Admin::find($aId);
            if (!$admin) {
                return $this->error('管理员不存在');
            }

            if ($password) {
                if ($password !== $request->post('password_confirmation')) {
                    return $this->error('密码和确认密码不一致');
                }
                $admin->password = password_hash($password, PASSWORD_DEFAULT);
            }
            if ($request->post('role_slugs')) {
                Permission::addRolesForUser('admin_' . $admin->id, $request->post('role_slugs'));
            }
            $admin->save();
            Db::commit();
            return $this->success($admin, '更新成功');
        } catch (\Throwable $th) {
            Db::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $aId = $request->post('id');
        $admin = Admin::find($aId);
        if ($admin->name === 'admin') {
            return $this->error('超级管理员不能删除');
        }
        if (!$admin) {
            return $this->error('管理员不存在');
        }
        $admin->delete();
        return $this->message('删除成功');
    }
}
