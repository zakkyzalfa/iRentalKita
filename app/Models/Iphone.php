<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iphone extends Model
{
    protected $table = 'iphones';
    protected $primaryKey = 'id_iphone';
    public $incrementing = true;

    protected $fillable = [
        'tipe_iphone',
        'imei',
        'warna',
        'status',
        'kondisi',
        'harga_per_hari',
        'gambar',
    ];
}