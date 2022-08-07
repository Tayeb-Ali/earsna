<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Admin Permissions
            ['name' => 'view subscriptions', 'type' => 'admin'],
            ['name' => 'add subscriptions', 'type' => 'admin'],
            ['name' => 'edit subscriptions', 'type' => 'admin'],
            ['name' => 'delete subscriptions', 'type' => 'admin'],
            ['name' => 'view packages', 'type' => 'admin'],
            ['name' => 'add packages', 'type' => 'admin'],
            ['name' => 'edit packages', 'type' => 'admin'],
            ['name' => 'delete packages', 'type' => 'admin'],
            ['name' => 'view features', 'type' => 'admin'],
            ['name' => 'add features', 'type' => 'admin'],
            ['name' => 'edit features', 'type' => 'admin'],
            ['name' => 'delete features', 'type' => 'admin'],
            ['name' => 'view advertisements', 'type' => 'admin'],
            ['name' => 'add advertisements', 'type' => 'admin'],
            ['name' => 'edit advertisements', 'type' => 'admin'],
            ['name' => 'delete advertisements', 'type' => 'admin'],
            ['name' => 'view clients', 'type' => 'admin'],
            ['name' => 'add clients', 'type' => 'admin'],
            ['name' => 'edit clients', 'type' => 'admin'],
            ['name' => 'delete clients', 'type' => 'admin'],
            ['name' => 'view fields', 'type' => 'admin'],
            ['name' => 'add fields', 'type' => 'admin'],
            ['name' => 'edit fields', 'type' => 'admin'],
            ['name' => 'delete fields', 'type' => 'admin'],

            // Client Permissions
            ['name' => 'view halls', 'type' => 'client'],
            ['name' => 'add halls', 'type' => 'client'],
            ['name' => 'edit halls', 'type' => 'client'],
            ['name' => 'delete halls', 'type' => 'client'],
            ['name' => 'view bookings', 'type' => 'client'],
            ['name' => 'add bookings', 'type' => 'client'],
            ['name' => 'edit bookings', 'type' => 'client'],
            ['name' => 'delete bookings', 'type' => 'client'],
            ['name' => 'view customers', 'type' => 'client'],
            ['name' => 'add customers', 'type' => 'client'],
            ['name' => 'edit customers', 'type' => 'client'],
            ['name' => 'delete customers', 'type' => 'client'],
            ['name' => 'view suppliers', 'type' => 'client'],
            ['name' => 'add suppliers', 'type' => 'client'],
            ['name' => 'edit suppliers', 'type' => 'client'],
            ['name' => 'delete suppliers', 'type' => 'client'],
            ['name' => 'view services', 'type' => 'client'],
            ['name' => 'add services', 'type' => 'client'],
            ['name' => 'edit services', 'type' => 'client'],
            ['name' => 'delete services', 'type' => 'client'],

            // Both Permissions
            ['name' => 'view dashboard', 'type' => 'both'],
            ['name' => 'view expenses', 'type' => 'both'],
            ['name' => 'add expenses', 'type' => 'both'],
            ['name' => 'edit expenses', 'type' => 'both'],
            ['name' => 'delete expenses', 'type' => 'both'],
            ['name' => 'view revenues', 'type' => 'both'],
            ['name' => 'add revenues', 'type' => 'both'],
            ['name' => 'edit revenues', 'type' => 'both'],
            ['name' => 'delete revenues', 'type' => 'both'],
            ['name' => 'view reports', 'type' => 'both'],
            ['name' => 'add reports', 'type' => 'both'],
            ['name' => 'edit reports', 'type' => 'both'],
            ['name' => 'delete reports', 'type' => 'both'],
            ['name' => 'view users', 'type' => 'both'],
            ['name' => 'add users', 'type' => 'both'],
            ['name' => 'edit users', 'type' => 'both'],
            ['name' => 'delete users', 'type' => 'both'],
            ['name' => 'view settings', 'type' => 'both'],
            ['name' => 'edit settings', 'type' => 'both'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
