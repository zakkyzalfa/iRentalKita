<?php

use Illuminate\Support\Facades\Route;

// Halaman Umum (Pages)
Route::get('/', fn () => view('pages.home'));
Route::get('/daftar-iphone', fn () => view('pages.daftar-iphone'));
Route::get('/detail-iphone', fn () => view('pages.detail-iphone'));

// Autentikasi
Route::get('/login-penyewa', fn () => view('auth.login-penyewa'));
Route::get('/login-admin', fn () => view('auth.login-admin'));
Route::get('/pendaftaran', fn () => view('auth.pendaftaran'));

// Penyewa
Route::prefix('penyewa')->group(function () {
    Route::get('/dashboard', fn () => view('penyewa.dashboard'));
    Route::get('/pembayaran', fn () => view('penyewa.pembayaran'));
    Route::get('/bukti-pembayaran', fn () => view('penyewa.bukti-pembayaran'));
    Route::get('/pengambilan', fn () => view('penyewa.proses-pengambilan'));
    Route::get('/pengembalian', fn () => view('penyewa.proses-pengembalian'));
});

// Admin / Petugas
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'));
    Route::get('/konfirmasi-pengambilan', fn () => view('admin.konfirmasi-pengambilan'));
    Route::get('/konfirmasi-pengembalian', fn () => view('admin.konfirmasi-pengembalian'));
    Route::get('/laporan', fn () => view('admin.laporan'));
    Route::get('/pemeriksaan', fn () => view('admin.pemeriksaan'));
    Route::get('/manajemen-iphone', fn () => view('admin.manajemen-iphone'));
    Route::get('/manajemen-penyewa', fn () => view('admin.manajemen-penyewa'));
});
