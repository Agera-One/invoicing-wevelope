<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'phone' => '0987654321',
                'password' => Hash::make('admin123'),
                'is_active' => 1,
                'company_id' => 1,
            ],
        ]);
    }
}
