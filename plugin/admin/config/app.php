<?php

use support\Request;

return [
    'debug' => true,
    'controller_suffix' => 'Controller',
    'controller_reuse' => false,
    'version' => '1.0.0',
    'public_path' => base_path('plugin' . DIRECTORY_SEPARATOR. 'admin' . DIRECTORY_SEPARATOR . 'public'),
    'controllers_path' => base_path('plugin' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controller'),
];
