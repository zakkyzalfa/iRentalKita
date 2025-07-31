<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iphone extends Model
{
    protected $fillable = [
        'tipe_iphone',
        'imei',
        'kondisi',
        'harga_per_hari',
        'gambar',
        'status',
    ];
    
}
