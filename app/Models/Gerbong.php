<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Seeders\KeretaSeeder;

class Gerbong extends Model
{
    protected $table = 'gerbong';
    protected $fillable = [
        'id',
        'gerbong',
        'kelas',
        'id_kereta'
    ];
    public function Kereta()
    {
        return $this->hasMany(KeretaSeeder::class);
    }
};
