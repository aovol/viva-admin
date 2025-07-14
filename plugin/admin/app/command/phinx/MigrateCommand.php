<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;
use Phinx\Console\Command\Migrate as PhinxMigrateCommand;

class MigrateCommand extends PhinxMigrateCommand
{
    protected static $defaultName = 'phinx:migrate';
    protected static string $defaultDescription = '迁移数据库';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
