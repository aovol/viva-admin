<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class TestCommand extends \Phinx\Console\Command\Test
{
    protected static $defaultName = 'phinx:test';

    protected static string $defaultDescription = '验证配置文件';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
