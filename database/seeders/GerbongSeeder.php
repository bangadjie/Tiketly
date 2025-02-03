<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GerbongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gerbong')->insert([
            [
                'gerbong' => '01',
                'kelas' => 'umum',
                'id_kereta' => 1,
            ],
            [
                'gerbong' => '02',
                'kelas' => 'umum',
                'id_kereta' => 2,
            ],
            [
                'gerbong' => '03',
                'kelas' => 'VVIP',
                'id_kereta' => 3,
            ],
        ]);
    }
}
