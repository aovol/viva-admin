<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Nodes extends AbstractMigration
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
        $table = $this->table('nodes');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('guard_name', 'string', ['limit' => 255, 'default' => 'admin'])
            ->addColumn('slug', 'string', ['limit' => 255])
            ->addColumn('parent_id', 'integer', ['limit' => 10, 'null' => true, 'default' => 0])
            ->addColumn('path', 'string', ['limit' => 255])
            ->addColumn('component', 'string', ['limit' => 255])
            ->addColumn('redirect', 'string', ['limit' => 255])
            ->addColumn('api', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('icon', 'string', ['limit' => 255])
            ->addColumn('sort', 'integer', ['limit' => 10, 'default' => 0])
            ->addColumn('lft', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('rgt', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('type', 'string', ['limit' => 255])
            ->addColumn('is_show', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('show_page_head', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['parent_id'])
            ->addIndex(['lft'])
            ->addIndex(['rgt'])
            ->addIndex(['is_show'])
            ->addIndex(['type'])
            ->addIndex(['status'])
            ->addIndex(['sort'])
            ->addIndex(['slug'], ['unique' => true])
            ->create();
    }
}
