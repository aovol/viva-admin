<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use plugin\admin\app\model\Role;

class RoleSeeder extends AbstractSeed
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
        $roles = [
            [
                'name' => '管理员',
                'slug' => 'admin',
            ],

        ];
        foreach ($roles as $role) {
            $role = Role::create($role);
        }
    }
}
