<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Nama tabel benar!
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pemesanan',
        'total_bayar',
        'metode_bayar',
        'bukti_bayar',
        'status'
    ];

    // timestamps true, karena kamu pakai $table->timestamps()
    public $timestamps = true;

    // Relasi ke Pemesanan (opsional)
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}