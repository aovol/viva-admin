<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email_verified_at', 'datetime', ['null' => true])
            ->addColumn('phone', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('phone_verified_at', 'datetime', ['null' => true])
            ->addColumn('money', 'decimal', ['limit' => 10, 'precision' => 2, 'null' => true])
            ->addColumn('freeze_money', 'decimal', ['limit' => 10, 'precision' => 2, 'null' => true])
            ->addColumn('integral', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('freeze_integral', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('group_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('last_login_id', 'datetime', ['null' => true])
            ->addColumn('invite_code', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('parent_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('avatar', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('nickname', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('gender', 'integer', ['limit' => 1, 'default' => 0])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('status', 'integer', ['limit' => 1, 'default' => 1])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['phone'], ['unique' => true])
            ->addIndex(['name'], ['unique' => true])
            ->addIndex(['group_id'])
            ->addIndex(['last_login_id'])
            ->addIndex(['parent_id'])
            ->addIndex(['invite_code'])
            ->create();
    }
}
