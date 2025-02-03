<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('pelanggan')->insert([
            [
                'NIK' => '12345678909876',
                'alamat' => 'Di mana aja bisa',
                'telp' => '093244556',
                'id_user' => '1'
            ]
        ]);
    }
}
