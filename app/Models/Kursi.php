<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Seeders\GerbongSeeder;

class Kursi extends Model
{
    protected $table = 'kursi';
    protected $fillable = [
        'id',
        'no_kursi',
        'id_gerbong',
    ];

    public function Gerbong()
    {
        return $this->hasMany(GerbongSeeder::class);
    }
}
