<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use plugin\admin\app\model\Admin;

class AdminSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'status' => 1,
        ]);
    }
}
