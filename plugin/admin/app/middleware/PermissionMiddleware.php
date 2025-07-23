<?php

namespace plugin\admin\app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Request;
use Webman\Http\Response;
use Casbin\WebmanPermission\Permission;
use Aovol\WebmanAuth\Facade\Auth;
use app\admin\model\Node;

class PermissionMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $except = ['/admin/login', '/admin/logout', '/admin/user'];
        if (in_array($request->path(), $except)) {
            return $handler($request);
        }
        $path = $request->path();
        $method = $request->method();
        $user = Auth::guard('admin')->user();
        if (!$user) {
            return response('unauthorized', 401);
        }
        $is = false;
        $permissionPath = preg_replace('/^\/admin(?=\/|$)/', '', $path);
        $permissions = Node::where([
            'type' => 'permission',
            'path' => $permissionPath,
        ])->select();
        foreach ($permissions as $permission) {
            if ($permission->path == $path && $permission->method == $method) {
                $is = true;
                break;
            }
        }

        if (!$is) {
            return response('permission forbidden', 403);
        }

        return $handler($request);
    }
}
