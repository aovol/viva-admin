<?php

namespace plugin\admin\app\command\phinx;

use Phinx\Config\Config;

class BreakpointCommand extends \Phinx\Console\Command\Breakpoint
{
    protected static $defaultName = 'phinx:breakpoint';

    protected static string $defaultDescription = '管理断点';

    public function __construct()
    {
        parent::__construct();
        $config = new Config(config('plugin.admin.phinx'), base_path() . '/plugin/admin/config/phinx.php');
        $this->setConfig($config);
    }
}
