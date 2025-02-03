<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KursiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kursi')->insert([
            ['no_kursi' => '1', 'id_gerbong' => '1'],
            ['no_kursi' => '2', 'id_gerbong' => '1'],
            ['no_kursi' => '3', 'id_gerbong' => '1'],
            ['no_kursi' => '4', 'id_gerbong' => '1'],
            ['no_kursi' => '5', 'id_gerbong' => '1'],
            ['no_kursi' => '6', 'id_gerbong' => '1'],
            ['no_kursi' => '7', 'id_gerbong' => '1'],
            ['no_kursi' => '8', 'id_gerbong' => '1'],
            ['no_kursi' => '9', 'id_gerbong' => '1'],
            ['no_kursi' => '10', 'id_gerbong' => '1'],

            // Menyisipkan 10 kursi untuk id_gerbong = 2
            ['no_kursi' => '1', 'id_gerbong' => '2'],
            ['no_kursi' => '2', 'id_gerbong' => '2'],
            ['no_kursi' => '3', 'id_gerbong' => '2'],
            ['no_kursi' => '4', 'id_gerbong' => '2'],
            ['no_kursi' => '5', 'id_gerbong' => '2'],
            ['no_kursi' => '6', 'id_gerbong' => '2'],
            ['no_kursi' => '7', 'id_gerbong' => '2'],
            ['no_kursi' => '8', 'id_gerbong' => '2'],
            ['no_kursi' => '9', 'id_gerbong' => '2'],
            ['no_kursi' => '10', 'id_gerbong' => '2'],

            // Menyisipkan 10 kursi untuk id_gerbong = 3
            ['no_kursi' => '1', 'id_gerbong' => '3'],
            ['no_kursi' => '2', 'id_gerbong' => '3'],
            ['no_kursi' => '3', 'id_gerbong' => '3'],
            ['no_kursi' => '4', 'id_gerbong' => '3'],
            ['no_kursi' => '5', 'id_gerbong' => '3'],
            ['no_kursi' => '6', 'id_gerbong' => '3'],
            ['no_kursi' => '7', 'id_gerbong' => '3'],
            ['no_kursi' => '8', 'id_gerbong' => '3'],
            ['no_kursi' => '9', 'id_gerbong' => '3'],
            ['no_kursi' => '10', 'id_gerbong' => '3'],
        ]);
    }
}
