<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PermissionGroups extends AbstractMigration
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
        $table = $this->table('permission_groups');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('parent_id', 'integer', ['limit' => 10, 'default' => 0])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['parent_id'])
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
