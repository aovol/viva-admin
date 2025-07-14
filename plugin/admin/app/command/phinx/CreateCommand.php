<?php

namespace plugin\admin\app\command\phinx;

use Webman\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phinx\Config\Config;

class CreateCommand extends \Phinx\Console\Command\Create
{
    protected static $defaultName = 'phinx:create';

    protected static string $defaultDescription = '创建Phinx迁移';

    public function __construct()
    {
        parent::__construct();
        var_dump(base_path() . '/plugin/admin/config/phinx.php');
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
