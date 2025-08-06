<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengembalian';

    protected $fillable = [
        'id_pemesanan',
        'tanggal_kembali_real',
        'kondisi_kembali',
        'denda',
        'alasan_denda',
        'status_bayar',
        'metode_bayar',
        'tanggal_bayar',
        'status_pengembalian',
        'keterlambatan_hari',
        'catatan_admin'
    ];

    protected $casts = [
        'kondisi_kembali' => 'array',
        'tanggal_bayar' => 'datetime',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}