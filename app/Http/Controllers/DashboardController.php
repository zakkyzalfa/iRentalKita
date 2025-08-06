<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iphone;
use App\Models\Penyewa;
// Jika ada model Rental, import juga
// use App\Models\Rental;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Ambil statistik iPhone
        $totalIphone  = Iphone::count();
        $tersedia     = Iphone::where('status', 'tersedia')->count();
        $disewa       = Iphone::where('status', 'disewa')->count();
        $penyewaCount = Penyewa::count();

        // Contoh data rental aktif (dummy), seharusnya dari DB
        $activeRentals = [
            [
                'id' => 'R001',
                'penyewa' => 'John Doe',
                'tipe_iphone' => 'iPhone 15 Pro Max 256GB',
                'mulai' => '2025-01-20',
                'kembali' => '2025-01-25',
                'total' => 250000,
                'status' => 'Aktif',
                'badge' => ['label' => 'Sedang Disewa', 'color' => 'orange'],
                'avatar' => 'J',
            ],
            [
                'id' => 'R002',
                'penyewa' => 'Sarah Wilson',
                'tipe_iphone' => 'iPhone 14 Pro 128GB',
                'mulai' => '2025-01-21',
                'kembali' => '2025-01-28',
                'total' => 266000,
                'status' => 'Lunas',
                'badge' => ['label' => 'Menunggu Ambil', 'color' => 'yellow'],
                'avatar' => 'S',
            ],
            [
                'id' => 'R003',
                'penyewa' => 'Mike Johnson',
                'tipe_iphone' => 'iPhone 13 128GB',
                'mulai' => '2025-01-15',
                'kembali' => '2025-01-19',
                'total' => 125000,
                'denda' => 50000,
                'status' => 'Terlambat',
                'badge' => ['label' => 'Terlambat', 'color' => 'red'],
                'avatar' => 'M',
            ],
        ];

        // Jika punya model Rental, bisa ganti dengan query, misal:
        // $activeRentals = Rental::with(['penyewa', 'iphone'])->where('status', 'aktif')->get();

        return view('admin.dashboard-admin', compact(
            'totalIphone', 'tersedia', 'disewa', 'penyewaCount', 'activeRentals'
        ));
    }

    public function dashboardPenyewa()
    {
        $penyewa = auth('penyewa')->user();

        $riwayat = \App\Models\Pemesanan::with(['iphone', 'pembayaran', 'pengambilan', 'pengembalian'])
            ->where('id_penyewa', $penyewa->id_penyewa)
            ->orderByDesc('created_at')
            ->get();

        // // TAMBAHKAN KODE INI DI SINI
        // dd($penyewa->id_penyewa, $riwayat);

        return view('penyewa.dashboard-penyewa', [
            'penyewa' => $penyewa,
            'riwayat' => $riwayat,
        ]);
    }
}