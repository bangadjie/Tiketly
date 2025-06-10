<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail_pembelian_tiket';
    protected $fillable = [
        'NIK',
        'id_pembelian_tiket',
        'id_gerbong',
        'id_kursi',
        'metode_pembayaran'
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembelian_tiket', 'id');
    }
}
