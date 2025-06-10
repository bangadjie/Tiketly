<?php

// app/Models/PembelianTiket.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'pembelian_tiket';

    protected $fillable = [
        'tanggal_pembelian',
        'id_pelanggan',
        'id_jadwal',
    ];
}
