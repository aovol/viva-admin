<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class RollbackCommand extends \Phinx\Console\Command\Rollback
{
    protected static $defaultName = 'migrate:rollback';

    protected static string $defaultDescription = '回滚最后一个或指定迁移';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
