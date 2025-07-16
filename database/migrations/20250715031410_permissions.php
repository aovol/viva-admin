<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Permissions extends AbstractMigration
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
        $table = $this->table('permissions');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('guard_name', 'string', ['limit' => 255])
            ->addColumn('group_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('slug', 'string', ['limit' => 255])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['name'])
            ->addIndex(['guard_name'])
            ->addIndex(['group_name'])
            ->addIndex(['slug'], ['unique' => true])
            ->create();
    }
}
