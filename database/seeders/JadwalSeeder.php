<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal')->insert([
            [
                'asal_keberangkatan' => 'Malang',
                'tujuan_keberangkatan' => 'Surabaya',
                'keberangkatan' => '2025-01-12 15:30:00',
                'kedatangan' => '2025-01-12 17:30:00',
                'harga' => '15.000',
                'id_kereta' => '1',
            ],
            [
                'asal_keberangkatan' => 'Surabaya',
                'tujuan_keberangkatan' => 'Malang',
                'keberangkatan' => '2025-01-12 17:00:00',
                'kedatangan' => '2025-01-12 18:15:00',
                'harga' => '15.000',
                'id_kereta' => '2',
            ],
            [
                'asal_keberangkatan' => 'Surabaya',
                'tujuan_keberangkatan' => 'Malang',
                'keberangkatan' => '2025-01-12 17:00:00',
                'kedatangan' => '2025-01-12 18:15:00',
                'harga' => '15.000',
                'id_kereta' => '2',
            ],
            [
                'asal_keberangkatan' => 'Surabaya',
                'tujuan_keberangkatan' => 'Madiun',
                'keberangkatan' => '2025-01-12 17:00:00',
                'kedatangan' => '2025-01-12 20:00:00',
                'harga' => '20.000',
                'id_kereta' => '3',
            ],

        ]);
    }
}
