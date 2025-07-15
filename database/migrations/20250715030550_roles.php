<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Roles extends AbstractMigration
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
        $table = $this->table('roles');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('guard_name', 'string', ['limit' => 255])
            ->addColumn('slug', 'string', ['limit' => 255])
            ->addColumn('description', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['name'], ['unique' => true])
            ->addIndex(['slug'], ['unique' => true])
            ->addIndex(['guard_name'])
            ->create();
    }
}
