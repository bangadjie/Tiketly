<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeretaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kereta')->insert([
            [
                'kereta' => 'Majapahit',
                'deskripsi' => 'kereta cepat',
                'kelas' => 'ekonomi'
            ],
            [
                'kereta' => 'Brawijaya',
                'deskripsi' => 'kereta cepat',
                'kelas' => 'ekonomi'
            ],
            [
                'kereta' => 'Gajayana',
                'deskripsi' => 'kereta cepat',
                'kelas' => 'VVIP'
            ],
        ]);
    }
}
