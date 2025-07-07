<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';

use EasyAuth\Auth;

echo "=== EasyAuth 完整测试 ===\n";

// 1. 测试登录
echo "\n1. 测试登录\n";
$result = Auth::login(['username' => 'admin', 'password' => '123456']);
echo "登录结果: " . json_encode($result, JSON_UNESCAPED_UNICODE) . "\n";

if ($result['success']) {
    // 2. 测试检查登录状态
    echo "\n2. 测试检查登录状态\n";
    $isLoggedIn = Auth::check();
    echo "是否登录: " . ($isLoggedIn ? '是' : '否') . "\n";

    // 3. 测试获取用户信息
    echo "\n3. 测试获取用户信息\n";
    $user = Auth::user();
    echo "用户信息: " . json_encode($user, JSON_UNESCAPED_UNICODE) . "\n";

    // 4. 测试登出
    echo "\n4. 测试登出\n";
    $logoutResult = Auth::logout();
    echo "登出结果: " . ($logoutResult ? '成功' : '失败') . "\n";

    // 5. 再次检查登录状态
    echo "\n5. 登出后检查登录状态\n";
    $isLoggedIn = Auth::check();
    echo "是否登录: " . ($isLoggedIn ? '是' : '否') . "\n";
}

// 6. 测试QQ登录
echo "\n6. 测试QQ登录\n";
$qqResult = Auth::qq()->doLogin(['code' => 'test_qq_code']);
echo "QQ登录结果: " . json_encode($qqResult, JSON_UNESCAPED_UNICODE) . "\n";

// 7. 测试微信登录
echo "\n7. 测试微信登录\n";
$wechatResult = Auth::wechat()->doLogin(['code' => 'test_wechat_code']);
echo "微信登录结果: " . json_encode($wechatResult, JSON_UNESCAPED_UNICODE) . "\n";

// 8. 测试管理员guard
echo "\n8. 测试管理员guard\n";
$adminResult = Auth::credential()->guard('admin')->doLogin(['username' => 'admin', 'password' => '123456']);
echo "管理员登录结果: " . json_encode($adminResult, JSON_UNESCAPED_UNICODE) . "\n";

echo "\n=== 测试完成 ===\n";
