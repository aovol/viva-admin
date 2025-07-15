<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class SeedCreateCommand extends \Phinx\Console\Command\SeedCreate
{
    protected static $defaultName = 'make:seed';

    protected static string $defaultDescription = '创建一个新的数据库种子';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
