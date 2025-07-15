<?php

namespace plugin\admin\app\command\phinx;

use Webman\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends \Phinx\Console\Command\Init
{
    protected static $defaultName = 'migrate:init';
    protected static $defaultDescription = '初始化Phinx';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $targetDir = base_path() . '/plugin/admin/config';
        $targetFile = $targetDir . '/phinx.php';

        // 检查并创建 database/migrations 和 database/seeds 目录
        $migrationDir = base_path() . '/database/migrations';
        $seedsDir = base_path() . '/database/seeds';
        if (!is_dir($migrationDir)) {
            mkdir($migrationDir, 0777, true);
            $output->writeln('<info>创建 migrations 目录: ' . $migrationDir . '</info>');
        }
        if (!is_dir($seedsDir)) {
            mkdir($seedsDir, 0777, true);
            $output->writeln('<info>创建 seeds 目录: ' . $seedsDir . '</info>');
        }

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (file_exists($targetFile)) {
            $output->writeln('<error>配置文件已存在: ' . $targetFile . '</error>');
            return self::FAILURE;
        }

        // 直接复制官方模板内容
        $template = <<<PHP
<?php
return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'your_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation',
];
PHP;
        file_put_contents($targetFile, $template);
        $output->writeln('<info>Phinx配置文件已生成: ' . $targetFile . '</info>');
        return self::SUCCESS;
    }
}
