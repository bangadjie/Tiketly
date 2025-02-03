<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_pembelian_tiket')->insert([
            [
                'NIK' => '3507150902070002',
                'id_pembelian_tiket' => '1',
                'id_kursi' => '2'
            ]
        ]);
    }
}
