<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pemesanan';

    protected $fillable = [
        'id_penyewa',
        'id_iphone',
        'tanggal_sewa',
        'tanggal_kembali',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa', 'id_penyewa');
    }

    public function iphone()
    {
        return $this->belongsTo(Iphone::class, 'id_iphone', 'id_iphone');
    }

    public function pembayaran()
    {
        // Ubah namespace dan nama model jika perlu
        return $this->hasOne(\App\Models\Pembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }

    // Relasi ke pengambilan (optional)
    public function pengambilan()
    {
        return $this->hasOne(\App\Models\Pengambilan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function pengembalian() {
        return $this->hasOne(Pengembalian::class, 'id_pemesanan', 'id_pemesanan');
    }
}