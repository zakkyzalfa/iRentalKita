<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iphone;
use App\Models\Penyewa;
use App\Models\Pemesanan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalIphone = Iphone::count();
        $tersedia = Iphone::where('status', 'Tersedia')->count();
        $disewa = Iphone::where('status', 'Disewa')->count();
        $penyewaCount = Penyewa::count();

        // Ambil SEMUA riwayat, baik aktif, selesai, atau ada denda
        $activeRentals = Pemesanan::with(['pembayaran', 'pengambilan', 'pengembalian', 'iphone', 'penyewa'])
            ->orderByDesc('created_at')
            ->get();
            
        return view('admin.dashboard-admin', compact(
            'totalIphone',
            'tersedia',
            'disewa',
            'penyewaCount',
            'activeRentals'
        ));
    }

    public function hapusPemesanan($id_pemesanan)
    {
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
        $pemesanan->delete();
        return redirect()->route('admin.dashboard-admin')->with('success', 'Riwayat sewa berhasil dihapus.');
    }
}