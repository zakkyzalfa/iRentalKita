<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IphoneController;
use App\Http\Controllers\PenyewaAuthController;
use App\Http\Controllers\Admin\PenyewaController; // pastikan sudah ada controller ini
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminDashboardController;

// ========================
// Halaman Umum
// ========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/daftar-iphone', [IphoneController::class, 'daftar'])->name('daftar-iphone');
Route::get('/detail-iphone/{id_iphone}', [IphoneController::class, 'show'])->name('detail-iphone');

// ========================
// Autentikasi Penyewa
// ========================
Route::get('/pendaftaran', [PenyewaAuthController::class, 'showRegisterForm'])->name('pendaftaran');
Route::post('/pendaftaran', [PenyewaAuthController::class, 'register'])->name('penyewa.register');
Route::get('/login-penyewa', [PenyewaAuthController::class, 'showLoginForm'])->name('login-penyewa');
Route::post('/login-penyewa', [PenyewaAuthController::class, 'login'])->name('penyewa.login');
Route::post('/logout-penyewa', [PenyewaAuthController::class, 'logout'])->name('penyewa.logout');

// ========================
// Group: Route login fallback untuk middleware 'auth'
// ========================
// Jika user guest akses route auth, redirect ke login penyewa
Route::get('/login', function () {
    return redirect()->route('login-penyewa');
})->name('login');

// ========================
// Dashboard Penyewa (setelah login)
// ========================
Route::get('/dashboard-penyewa', [DashboardController::class, 'dashboardPenyewa'])
    ->middleware('auth:penyewa')
    ->name('dashboard-penyewa');
Route::post('/penyewa/update-profile', [PenyewaAuthController::class, 'updateProfile'])
    ->middleware('auth:penyewa')
    ->name('penyewa.update-profile');

// Konfirmasi Pengembalian
// Route::get('/konfirmasi-pengembalian/{id_pemesanan}', [PemesananController::class, 'konfirmasiPengembalian'])->name('konfirmasi.pengembalian');
// Route::post('/konfirmasi-pengembalian/{id_pemesanan}', [PemesananController::class, 'prosesKonfirmasiPengembalian'])->name('konfirmasi.pengembalian.proses');

// Route::get('/konfirmasi-pengembalian/{id_pemesanan}', [\App\Http\Controllers\KonfirmasiPengembalianController::class, 'show'])->name('konfirmasi.pengembalian');
// Route::post('/konfirmasi-pengembalian/{id_pemesanan}/konfirmasi', [\App\Http\Controllers\KonfirmasiPengembalianController::class, 'konfirmasi'])->name('konfirmasi.pengembalian.konfirmasi');
// Route::post('/konfirmasi-pengembalian/{id_pemesanan}/bayar-denda', [\App\Http\Controllers\KonfirmasiPengembalianController::class, 'bayarDenda'])->name('konfirmasi.pengembalian.bayar-denda');

// ========================
// Login Admin (hanya view dulu)
// ========================
Route::view('/login-admin', 'auth.login-admin')->name('login-admin');

// ========================
// Manajemen Penyewa (Admin)
// ========================
// Untuk sekarang, tanpa middleware auth/admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/manajemen-penyewa', [PenyewaController::class, 'index'])->name('manajemen-penyewa');
    Route::get('/manajemen-penyewa/{id}', [PenyewaController::class, 'show'])->name('detail-penyewa');
    Route::delete('/manajemen-penyewa/{id}', [PenyewaController::class, 'destroy'])->name('hapus-penyewa');

    Route::resource('manajemen-iphone', IphoneController::class)
        ->parameters(['manajemen-iphone' => 'id_iphone'])
        ->names('iphones');

    // Dashboard Admin
    Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])->name('dashboard-admin');
    // Proses Pengembalian (placeholder, ganti dengan controller aslinya jika sudah ada)
    // Route::get('/proses-pengembalian/{id}', function($id){
    //     return "Halaman proses pengembalian untuk ID: " . $id;
    // })->name('proses-pengembalian');
    // Laporan
    Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan');
    // Logout admin
    Route::post('/logout', function() {
        session()->forget('is_admin_logged_in');
        return redirect()->route('login-admin');
    })->name('logout');

    Route::get('/proses-pengembalian/{id_pemesanan}', [\App\Http\Controllers\Admin\ProsesPengembalianController::class, 'show'])->name('proses-pengembalian');
    Route::post('/proses-pengembalian/{id_pemesanan}', [\App\Http\Controllers\Admin\ProsesPengembalianController::class, 'proses'])->name('proses-pengembalian.proses');

    Route::delete('/rental/{id_pemesanan}', [App\Http\Controllers\AdminDashboardController::class, 'hapusPemesanan'])
        ->name('hapus-pemesanan');
});

// Auth Admin
Route::post('/login-admin', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', function() {
    session()->forget('is_admin_logged_in');
    return redirect()->route('login-admin');
})->name('admin.logout');

Route::post('/admin/logout', function() {
    // Hapus session login admin
    session()->forget('is_admin_logged_in');
    // Redirect ke halaman login admin
    return redirect()->route('login-admin');
})->name('admin.logout');

// ========================
// Proses Penyewaan & Pembayaran (hanya untuk penyewa yang login)
// ========================
Route::middleware(['auth:penyewa'])->group(function() {
    Route::post('/sewa/{id_iphone}', [PemesananController::class, 'store'])->name('sewa.proses');
    Route::get('/pembayaran/{id_pemesanan}', [PemesananController::class, 'pembayaran'])->name('pembayaran.show');
    // Tambahkan route lain yang butuh login penyewa di sini
    Route::get('/konfirmasi-pengembalian/{id_pemesanan}', [\App\Http\Controllers\KonfirmasiPengembalianController::class, 'show'])->name('konfirmasi.pengembalian');
    Route::post('/konfirmasi-pengembalian/{id_pemesanan}/konfirmasi', [\App\Http\Controllers\KonfirmasiPengembalianController::class, 'konfirmasi'])->name('konfirmasi.pengembalian.konfirmasi');
    Route::post('/konfirmasi-pengembalian/{id_pemesanan}/bayar-denda', [\App\Http\Controllers\KonfirmasiPengembalianController::class, 'bayarDenda'])->name('konfirmasi.pengembalian.bayar-denda');
});

// Halaman pembayaran (GET)
Route::get('/pembayaran/{id_pemesanan}', [\App\Http\Controllers\PembayaranController::class, 'showForm'])->name('pembayaran.show');

// Proses pembayaran (POST AJAX)
Route::post('/pembayaran/{id_pemesanan}/proses', [\App\Http\Controllers\PembayaranController::class, 'proses'])->name('pembayaran.proses');

// Halaman bukti pembayaran (GET)
Route::get('/bukti-pembayaran/{id_pembayaran}', [\App\Http\Controllers\PembayaranController::class, 'bukti'])->name('bukti.pembayaran');

// Konfirmasi Pengambilan
Route::get('/konfirmasi-pengambilan/{id_pemesanan}', [PemesananController::class, 'konfirmasiPengambilan'])->name('konfirmasi.pengambilan');
Route::post('/konfirmasi-pengambilan/{id_pemesanan}', [PemesananController::class, 'prosesKonfirmasiPengambilan'])->name('konfirmasi.pengambilan.proses');
Route::get('/konfirmasi-pengembalian/{id_pemesanan}', [PemesananController::class, 'showKonfirmasiPengembalian'])->name('konfirmasi.pengembalian');
Route::get('/admin/proses-pengembalian/{id_pemesanan}', [\App\Http\Controllers\Admin\ProsesPengembalianController::class, 'show'])->name('admin.proses-pengembalian');


Route::get('/admin/proses-pengembalian/{id_pemesanan}', [\App\Http\Controllers\Admin\ProsesPengembalianController::class, 'show'])->name('admin.proses-pengembalian');
Route::post('/admin/proses-pengembalian/{id_pemesanan}', [\App\Http\Controllers\Admin\ProsesPengembalianController::class, 'proses'])->name('admin.proses-pengembalian.proses');


// ========================
// Route fallback (optional)
// ========================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});