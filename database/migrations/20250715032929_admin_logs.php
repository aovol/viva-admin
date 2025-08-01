<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AdminLogs extends AbstractMigration
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
        $table = $this->table('admin_logs');
        $table->addColumn('admin_id', 'integer', ['limit' => 10])
            ->addColumn('type', 'string', ['limit' => 255])
            ->addColumn('ip', 'string', ['limit' => 255])
            ->addColumn('user_agent', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['admin_id', 'ip', 'user_agent'])
            ->create();
    }
}
