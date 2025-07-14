<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class StatusCommand extends \Phinx\Console\Command\Status
{
    protected static $defaultName = 'phinx:status';

    protected static string $defaultDescription = '显示迁移状态';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
