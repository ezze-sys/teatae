<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin Owner',
            'email' => 'admin@sinarterang.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $staff = \App\Models\User::create([
            'name' => 'Staff Cashier',
            'email' => 'staff@sinarterang.com',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole('staff');
    }
}
