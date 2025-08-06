<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Penyewa;
use App\Models\Pengembalian;
use Carbon\Carbon;
use DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil bulan dari request (format: YYYY-MM)
        $selectedMonth = $request->get('bulan', Carbon::now()->format('Y-m'));
        $year = substr($selectedMonth, 0, 4);
        $month = substr($selectedMonth, 5, 2);

        // 2. Buat label bulan untuk dropdown selector
        $availableMonths = [];
        $now = Carbon::now();
        for ($i = 0; $i < 12; $i++) {
            $date = $now->copy()->subMonths($i);
            $key = $date->format('Y-m');
            $label = $date->locale('id_ID')->isoFormat('MMMM YYYY');
            $availableMonths[$key] = ucfirst($label);
        }

        // 3. Query total transaksi (jumlah pemesanan selesai pada bulan ini)
        $totalTransaksi = Pemesanan::whereYear('tanggal_sewa', $year)
            ->whereMonth('tanggal_sewa', $month)
            ->count();

        // 4. Query total pendapatan (total pembayaran Lunas pada bulan ini)
        $totalPendapatan = Pemesanan::whereYear('tanggal_sewa', $year)
            ->whereMonth('tanggal_sewa', $month)
            ->whereHas('pembayaran', function($q){
                $q->where('status', 'Lunas');
            })
            ->with('pembayaran')
            ->get()
            ->sum(function($p){
                return $p->pembayaran->total_bayar ?? 0;
            });

        // 5. Query total denda (total denda dari pengembalian pada bulan ini)
        $totalDenda = Pengembalian::whereYear('tanggal_kembali_real', $year)
            ->whereMonth('tanggal_kembali_real', $month)
            ->sum('denda');

        // 6. Query total penyewa baru (yang mendaftar di bulan ini)
        $totalPenyewaBaru = Penyewa::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        // Kirim ke blade
        return view('admin.laporan', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalDenda',
            'totalPenyewaBaru',
            'availableMonths',
            'selectedMonth'
        ));
    }
}