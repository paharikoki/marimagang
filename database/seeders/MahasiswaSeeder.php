<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            [
                'nim' => '2041720220',
                'email' => 'nickarieska@gmail.com',
                'password' => Hash::make('password'),
                'verify' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '9876543210',
                'email' => 'user2@example.com',
                'password' => Hash::make('password2'),
                'verify' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '1111111111',
                'email' => 'user3@example.com',
                'password' => Hash::make('password3'),
                'verify' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($usersData);
    }
}
