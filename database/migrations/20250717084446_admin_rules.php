<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AdminRules extends AbstractMigration
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
        $table = $this->table('admin_rules');
        $table->addColumn('ptype', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addColumn('v0', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addColumn('v1', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addColumn('v2', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addColumn('v3', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addColumn('v4', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addColumn('v5', 'string', ['limit' => 128, 'null' => false, 'default' => ''])
            ->addIndex(['ptype'])
            ->addIndex(['v0'])
            ->addIndex(['v1'])
            ->addIndex(['v2'])
            ->addIndex(['v3'])
            ->addIndex(['v4'])
            ->addIndex(['v5'])
            ->create();
    }
}
