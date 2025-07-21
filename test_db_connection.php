<?php

require_once __DIR__ . '/vendor/autoload.php';

use support\bootstrap\Container;
use Webman\Config;

// 加载配置
Config::load(config_path(), ['route', 'container']);

echo "=== 数据库连接测试 ===\n";

try {
    // 获取数据库配置
    $config = config('database.connections.mysql');
    echo "数据库配置:\n";
    echo "主机: " . ($config['host'] ?? '未设置') . "\n";
    echo "端口: " . ($config['port'] ?? '未设置') . "\n";
    echo "数据库名: " . ($config['database'] ?? '未设置') . "\n";
    echo "用户名: " . ($config['username'] ?? '未设置') . "\n";
    echo "密码: " . (empty($config['password']) ? '空' : '已设置') . "\n";

    // 测试 PDO 连接
    echo "\n=== 测试 PDO 连接 ===\n";
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset=utf8";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    echo "✓ PDO 连接成功\n";

    // 测试查询
    $stmt = $pdo->query("SELECT VERSION() as version");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "MySQL 版本: " . $result['version'] . "\n";

    // 测试 ThinkORM 连接
    echo "\n=== 测试 ThinkORM 连接 ===\n";
    $connection = \think\facade\Db::connection('mysql');
    $result = $connection->query("SELECT 1 as test");
    echo "✓ ThinkORM 连接成功\n";

    // 测试 Casbin 相关表
    echo "\n=== 检查 Casbin 相关表 ===\n";
    $tables = $connection->query("SHOW TABLES LIKE '%casbin%'");
    if (empty($tables)) {
        echo "⚠ 未找到 Casbin 相关表\n";
    } else {
        echo "✓ 找到 Casbin 相关表:\n";
        foreach ($tables as $table) {
            echo "  - " . array_values($table)[0] . "\n";
        }
    }

    echo "\n=== 测试完成 ===\n";
    echo "✓ 数据库连接正常\n";
} catch (PDOException $e) {
    echo "❌ PDO 连接失败: " . $e->getMessage() . "\n";
    echo "可能的原因:\n";
    echo "1. 数据库服务未启动\n";
    echo "2. 主机地址错误 (如果使用 Docker，请检查容器地址)\n";
    echo "3. 端口号错误\n";
    echo "4. 用户名或密码错误\n";
    echo "5. 数据库名不存在\n";
} catch (Exception $e) {
    echo "❌ 其他错误: " . $e->getMessage() . "\n";
}

echo "\n=== 网络连接测试 ===\n";
$host = $config['host'] ?? '127.0.0.1';
$port = $config['port'] ?? 3306;

// 测试网络连接
$connection = @fsockopen($host, $port, $errno, $errstr, 5);
if ($connection) {
    echo "✓ 网络连接到 {$host}:{$port} 成功\n";
    fclose($connection);
} else {
    echo "❌ 网络连接到 {$host}:{$port} 失败: $errstr ($errno)\n";
    echo "建议检查:\n";
    echo "1. 如果使用 Docker，请确认容器地址是否正确\n";
    echo "2. 检查防火墙设置\n";
    echo "3. 确认数据库服务是否运行\n";
}
