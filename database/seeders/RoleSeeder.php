<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super_admin',],
            ['name' => 'admin',],
            [
                'name' => 'accountant',
                'permissions' => [
                    'view dashboard',
                    'view expenses',
                    'add expenses',
                    'edit expenses',
                    'delete expenses',
                    'view revenues',
                    'add revenues',
                    'edit revenues',
                    'delete revenues',
                    'view reports',
                    'add reports',
                    'edit reports',
                    'delete reports',
                ],
            ],
            [
                'name' => 'data_entry',
                'permissions' => [
                    'view subscriptions',
                    'add subscriptions',
                    'edit subscriptions',
                    'delete subscriptions',
                    'view packages',
                    'add packages',
                    'edit packages',
                    'delete packages',
                    'view features',
                    'add features',
                    'edit features',
                    'delete features',
                    'view advertisements',
                    'add advertisements',
                    'edit advertisements',
                    'delete advertisements',
                    'view clients',
                    'add clients',
                    'edit clients',
                    'delete clients',
                    'view fields',
                    'add fields',
                    'edit fields',
                    'delete fields',
                    'view halls',
                    'add halls',
                    'edit halls',
                    'delete halls',
                    'view services',
                    'add services',
                    'edit services',
                    'delete services',
                ]
            ],
        ];

        foreach ($roles as $role) {
            $r = Role::create(['name' => $role['name']]);

            if (in_array($r->name, ['accountant', 'data_entry'])) {
                foreach ($role['permissions'] as $permission) {
                    $r->givePermissionTo($permission);
                }
            }
        }
    }
}
