<?php

/**
 * @desc permission.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/01/12 20:20
 */
return [
    'default' => 'basic',
    /** 日志配置 */
    'log' => [
        'enabled' => false, // changes will log messages to the Logger.
        'logger' => 'Casbin', // Casbin Logger, Supported: \Psr\Log\LoggerInterface|string
        'path' => runtime_path() . '/logs/casbin.log' // log path
    ],
    /** 默认配置 */
    'basic' => [
        // 策略模型Model设置
        'model' => [
            'config_type' => 'file',
            'config_file_path' => config_path() . '/plugin/casbin/webman-permission/rbac-model.conf',
            'config_text' => '',
        ],
        // 适配器
         //'adapter' => Casbin\WebmanPermission\Adapter\DatabaseAdapter::class, // ThinkORM 适配器
        'adapter' => Casbin\WebmanPermission\Adapter\LaravelDatabaseAdapter::class, // Laravel 适配器
        // 数据库设置
        'database' => [
            'connection' => 'mysql',
            'rules_table' => 'admin_rules',
            'rules_name' => null
        ],
    ],
    /** 其他扩展配置，只需要按照基础配置一样，复制一份，指定相关策略模型和适配器即可 */
    'restful' => [
        'model' => [
            'config_type' => 'file',
            'config_file_path' => config_path() . '/plugin/casbin/webman-permission/restful-model.conf',
            'config_text' => '',
        ],
        'adapter' => Casbin\WebmanPermission\Adapter\DatabaseAdapter::class, // ThinkORM 适配器
        'database' => [
            'connection' => '',
            'rules_table' => 'rules',
            'rules_name' => null
        ],
    ],
];
