<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembelian_tiket')->insert([
            [
                'tanggal_pembelian' => '2025-01-12',
                'id_pelanggan' => '1',
                'id_jadwal' => '1'
            ]
        ]);
    }
}
