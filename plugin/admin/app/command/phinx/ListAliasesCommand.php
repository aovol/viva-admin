<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class ListAliasesCommand extends \Phinx\Console\Command\ListAliases
{
    protected static $defaultName = 'migrate:list';

    protected static string $defaultDescription = '列出模板类别名';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
