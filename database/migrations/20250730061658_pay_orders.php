<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PayOrders extends AbstractMigration
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
        $table = $this->table('pay_orders');
        $table->addColumn('order_no', 'string', ['limit' => 255, 'comment' => '订单号'])
            ->addColumn('original_order_no', 'string', ['limit' => 255, 'comment' => '原始订单号', 'null' => true])
            ->addColumn('merchant_id', 'integer', ['limit' => 11, 'comment' => '商户ID'])
            ->addColumn('channel_id', 'integer', ['limit' => 11, 'comment' => '通道ID'])
            ->addColumn('channel_type', 'string', ['limit' => 255, 'comment' => '通道类型'])
            ->addColumn('origin_amount', 'decimal', ['limit' => 10, 'precision' => 2, 'comment' => '原始订单金额', 'default' => 0])
            ->addColumn('cost_amount', 'decimal', ['limit' => 10, 'precision' => 2, 'comment' => '成本金额', 'default' => 0])
            ->addColumn('amount', 'decimal', ['limit' => 10, 'precision' => 2, 'comment' => '订单金额', 'default' => 0])
            ->addColumn('currency', 'string', ['limit' => 255, 'comment' => '货币', 'default' => 'CNY'])
            ->addColumn('pay_status', 'integer', ['limit' => 1, 'comment' => '支付状态', 'default' => 0])
            ->addColumn('pay_time', 'datetime', ['null' => true, 'comment' => '支付时间'])
            ->addColumn('status', 'integer', ['limit' => 1, 'comment' => '订单状态', 'default' => 0])
            ->addColumn('created_at', 'datetime', ['null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'comment' => '更新时间'])

            ->addIndex(['order_no'], ['unique' => true])
            ->addIndex(['merchant_id'])
            ->addIndex(['channel_id'])
            ->addIndex(['channel_type'])
            ->addIndex(['pay_status'])
            ->addIndex(['status'])
            ->create();
    }
}
