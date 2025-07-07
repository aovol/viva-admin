<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';

use EasyAuth\Auth;

echo "=== EasyAuth 测试 ===\n";

// 测试登录
$result = Auth::login(['username' => 'admin', 'password' => '123456']);
echo "登录结果: " . json_encode($result, JSON_UNESCAPED_UNICODE) . "\n";

// 测试检查登录状态
$isLoggedIn = Auth::check();
echo "是否登录: " . ($isLoggedIn ? '是' : '否') . "\n";

// 测试获取用户信息
$user = Auth::user();
echo "用户信息: " . json_encode($user, JSON_UNESCAPED_UNICODE) . "\n";

// 测试登出
$logoutResult = Auth::logout();
echo "登出结果: " . ($logoutResult ? '成功' : '失败') . "\n";

// 再次检查登录状态
$isLoggedIn = Auth::check();
echo "登出后是否登录: " . ($isLoggedIn ? '是' : '否') . "\n";
