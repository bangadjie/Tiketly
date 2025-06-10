<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Seeders\KeretaSeeder;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'id',
        'asal_keberangkatan',
        'tujuan_keberangkatan',
        'keberangkatan',
        'kedatangan',
        'harga',
        'id_kereta'
    ];
    public function Kereta()
    {
        return $this->belongsTo(KeretaSeeder::class);
    }
};
