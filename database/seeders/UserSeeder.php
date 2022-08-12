<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [[
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'password' => '123123',
            'phone' => '0123456799'],
            [
                'name' => 'Admin2',
                'email' => 'user@demo.com',
                'password' => '123123',
                'phone' => '0123456700'],
            [
                'name' => 'Mohammed Arbab',
                'email' => 'test@demo.com',
                'password' => '123123',
                'phone' => '0123456789'
            ]];
        foreach ($admins as $admin) {
            $admin = User::create($admin);
            $admin->assignRole('super_admin');
        }

        User::factory(2)->create()->each(function ($user) {
            $user->assignRole('admin');
        });
    }
}
