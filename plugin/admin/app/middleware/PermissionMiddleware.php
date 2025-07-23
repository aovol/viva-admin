<?php

namespace plugin\admin\app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Request;
use Webman\Http\Response;
use Casbin\WebmanPermission\Permission;
use Aovol\WebmanAuth\Facade\Auth;
use plugin\admin\app\model\Node;

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

        $can = false;
        $nodes = Node::where('path', $permissionPath)->get();
        foreach ($nodes as $node) {
            if (Permission::enforce('admin_' . $user->id, $node->slug, strtoupper($method))) {
                $can = true;
                break;
            }
        }
        if (!$can) {
            return response('permission forbidden', 403);
        }

        return $handler($request);
    }
}
