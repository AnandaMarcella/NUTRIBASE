<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Koordinator Utama',
                'username'   => 'koordinator',
                'password'   => Hash::make('password'),
                'role'       => 'koordinator',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Tresia Annisa Diella',
                'username'   => 'kader1',
                'password'   => Hash::make('password'),
                'role'       => 'kader',
                'is_super'   => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Rina Nurmardiati',
                'username'   => 'kader2',
                'password'   => Hash::make('password'),
                'role'       => 'kader',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
         
                        [
                'name'       => 'Li Sunarti',
                'username'   => 'kader3',
                'password'   => Hash::make('password'),
                'role'       => 'kader',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'name'       => 'Menika',
                'username'   => 'kader4',
                'password'   => Hash::make('password'),
                'role'       => 'kader',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'name'       => 'Sutanti',
                'username'   => 'kader5',
                'password'   => Hash::make('password'),
                'role'       => 'kader',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Penerima Satu',
                'username'   => 'penerima1',
                'password'   => Hash::make('password'),
                'role'       => 'penerima',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Penerima Dua',
                'username'   => 'penerima2',
                'password'   => Hash::make('password'),
                'role'       => 'penerima',
                'is_super'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}