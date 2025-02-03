<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\str;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('grups')->insert([
        // ]);
        $faker = Faker::create();

        DB::table('users')->insert([
            [
                'name' => 'Petugas',
                'role' => 'admin',
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),

            ],
            [
                'name' => 'pengguna',
                'role' => 'pengguna',
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
        ]);
    }
}
