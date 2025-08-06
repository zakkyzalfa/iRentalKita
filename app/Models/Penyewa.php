<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Penyewa extends Authenticatable
{
    protected $table = 'penyewas';
    protected $primaryKey = 'id_penyewa';

    protected $fillable = [
        'nama', 'email', 'password', 'alamat', 'no_hp', 'no_ktp', 'tanggal_daftar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;
}