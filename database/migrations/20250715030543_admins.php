<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Admins extends AbstractMigration
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
        $table = $this->table('admins');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('last_login_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
