<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengambilan extends Model
{
    protected $primaryKey = 'id_pengambilan';

    protected $fillable = [
        'id_pemesanan',
        'tanggal_pengambilan',
        'kondisi_awal'
    ];

    // Relasi ke Pemesanan (optional)
    public function pemesanan()
    {
        return $this->belongsTo(\App\Models\Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}