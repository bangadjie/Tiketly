<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ma_petugas');
        // $table->text('alamat');
        // $table->string('telp');
        // $table->foreignId('id_user')->co
        DB::table('petugas')->insert([
            [
                'petugas' => 'adjie',
                'alamat' => 'Dimana mana aku ada',
                'telp' => '0987654321',
                'id_user' => '1'
            ]
        ]);
    }
}
