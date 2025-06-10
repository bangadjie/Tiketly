<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Seeders\PetugasSeeder;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = [
        'NIK',
        'alamat',
        'telp',
        'id_user'
    ];
    // public function Kereta()
    // {
    //     return $this->belongsTo(KeretaSeeder::class);
    // }
};
