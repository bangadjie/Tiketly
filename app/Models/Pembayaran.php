<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembelian_tiket';
    protected $fillable = [
        'tanggal_pembelian',
        'id_pelanggan',
        'id_jadwal',
    ];
    public function detail()
    {
        return $this->hasMany(Detail::class, 'id_pembelian_tiket', 'id');
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}
