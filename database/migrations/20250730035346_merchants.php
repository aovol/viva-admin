<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Merchants extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $this->table('merchants')
            ->addColumn('name', 'string', ['limit' => 255, 'null' => true, 'comment' => '商户名称'])
            ->addColumn('username', 'string', ['limit' => 255, 'null' => true, 'comment' => '用户名'])
            ->addColumn('nickname', 'string', ['limit' => 255, 'null' => true, 'comment' => '昵称'])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true, 'comment' => '邮箱'])
            ->addColumn('email_verified_at', 'datetime', ['null' => true, 'comment' => '邮箱验证时间'])
            ->addColumn('phone', 'string', ['limit' => 255, 'null' => true, 'comment' => '手机号'])
            ->addColumn('phone_verified_at', 'datetime', ['null' => true, 'comment' => '手机号验证时间'])
            ->addColumn('money', 'decimal', ['limit' => 10, 'precision' => 2, 'null' => true, 'default' => 0, 'comment' => '余额'])
            ->addColumn('money_freeze', 'decimal', ['limit' => 10, 'precision' => 2, 'null' => true, 'default' => 0, 'comment' => '冻结余额'])
            ->addColumn('password', 'string', ['limit' => 255, 'null' => true, 'comment' => '密码'])
            ->addColumn('avatar', 'string', ['limit' => 255, 'null' => true, 'comment' => '头像'])
            ->addColumn('gender', 'integer', ['limit' => 1, 'null' => true, 'comment' => '性别'])
            ->addColumn('identity_status', 'integer', ['limit' => 1, 'null' => true, 'comment' => '身份状态'])
            ->addColumn('identity_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '身份证号'])
            ->addColumn('country', 'string', ['limit' => 255, 'null' => true, 'comment' => '国家'])
            ->addColumn('province', 'string', ['limit' => 255, 'null' => true, 'comment' => '省份'])
            ->addColumn('city', 'string', ['limit' => 255, 'null' => true, 'comment' => '城市'])
            ->addColumn('address', 'string', ['limit' => 255, 'null' => true, 'comment' => '地址'])
            ->addColumn('status', 'integer', ['limit' => 1, 'null' => true, 'comment' => '状态'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'comment' => '更新时间'])

            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['phone'], ['unique' => true])
            ->addIndex(['username'], ['unique' => true])

            ->create();
    }
}
