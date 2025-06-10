<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Seeders\PetugasSeeder;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $fillable = [
        'petugas',
        'alamat',
        'telp',
        'id_user'
    ];
    // public function Kereta()
    // {
    //     return $this->belongsTo(KeretaSeeder::class);
    // }
};
