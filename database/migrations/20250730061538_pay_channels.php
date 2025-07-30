<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PayChannels extends AbstractMigration
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
        $this->table('pay_channels')
            ->addColumn('name', 'string', ['limit' => 255, 'comment' => '通道名称'])
            ->addColumn('code', 'string', ['limit' => 255, 'comment' => '通道编码'])
            ->addColumn('type_code', 'string', ['limit' => 255, 'comment' => '通道类型编码'])
            ->addColumn('app_id', 'string', ['limit' => 255, 'null' => true, 'comment' => '应用ID'])
            ->addColumn('public_key', 'string', ['limit' => 255, 'null' => true, 'comment' => '公钥'])
            ->addColumn('private_key', 'string', ['limit' => 255, 'null' => true, 'comment' => '私钥'])
            ->addColumn('notify_url', 'string', ['limit' => 255, 'null' => true, 'comment' => '异步通知地址'])
            ->addColumn('return_url', 'string', ['limit' => 255, 'null' => true, 'comment' => '同步返回地址'])
            ->addColumn('sort', 'integer', ['limit' => 11, 'comment' => '排序'])
            ->addColumn('is_show', 'integer', ['limit' => 1, 'comment' => '是否显示'])
            ->addColumn('is_default', 'integer', ['limit' => 1, 'null' => true, 'comment' => '是否默认'])
            ->addColumn('status', 'integer', ['limit' => 1, 'null' => true, 'comment' => '状态'])
            ->addColumn('deleted_at', 'datetime', ['null' => true, 'comment' => '删除时间'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'comment' => '更新时间'])
            ->addIndex(['code'], ['unique' => true])
            ->addIndex(['type_code'])
            ->addIndex(['is_show'])
            ->addIndex(['is_default'])
            ->addIndex(['status'])
            ->create();
    }
}
