<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\JadwalSeeder;

class Kereta extends Model
{
    // use HasFactory;

    protected $table = 'kereta'; // Pastikan sesuai dengan nama tabel di database
    protected $fillable = ['kereta', 'deskripsi', 'kelas']; // Pastikan field sesuai migrasi

    public function Jadwal()
    {
        return $this->hasMany(JadwalSeeder::class);
    }
}
