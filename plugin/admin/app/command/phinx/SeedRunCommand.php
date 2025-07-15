<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class SeedRunCommand extends \Phinx\Console\Command\SeedRun
{
    protected static $defaultName = 'db:seed';

    protected static string $defaultDescription = '运行数据库种子';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
