<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PaySettings extends AbstractMigration
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
        $table = $this->table('pay_settings');
        $table->addColumn('name', 'string', ['limit' => 255, 'comment' => '设置名称'])
            ->addColumn('value', 'string', ['limit' => 255, 'comment' => '设置值'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'comment' => '更新时间'])

            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
