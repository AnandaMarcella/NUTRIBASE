<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_users')->insert([
            [
                'name'       => 'Admin Rental',
                'email'      => 'admin@rental.com',
                'password'   => Hash::make('password123'),
                'role'       => 'admin',
                'no_hp'      => '081234567890',
                'alamat'     => 'Jl. Admin No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Owner Rental',
                'email'      => 'owner@rental.com',
                'password'   => Hash::make('password123'),
                'role'       => 'owner',
                'no_hp'      => '081234567891',
                'alamat'     => 'Jl. Owner No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Budi Santoso',
                'email'      => 'customer@rental.com',
                'password'   => Hash::make('password123'),
                'role'       => 'customer',
                'no_hp'      => '081234567892',
                'alamat'     => 'Jl. Customer No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
