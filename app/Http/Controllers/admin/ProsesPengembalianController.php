<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pengembalian;
use App\Models\Iphone;
use Carbon\Carbon;

class ProsesPengembalianController extends Controller
{
    // Tampilkan form pemeriksaan pengembalian
    public function show($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone', 'pengembalian'])->findOrFail($id_pemesanan);

        // Untuk UI: hitung durasi sewa
        $tanggal_sewa = Carbon::parse($pemesanan->tanggal_sewa);
        $tanggal_kembali = Carbon::parse($pemesanan->tanggal_kembali);
        $durasi = $tanggal_sewa->diffInDays($tanggal_kembali);

        // Hitung keterlambatan (jika sudah lewat tanggal_kembali)
        $today = Carbon::now();
        $keterlambatan = $today->isAfter($tanggal_kembali) ? $tanggal_kembali->diffInDays($today) : 0;

        return view('admin.proses-pengembalian', compact('pemesanan', 'durasi', 'keterlambatan'));
    }

    // Proses form pemeriksaan pengembalian
    public function proses(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone', 'pengembalian'])->findOrFail($id_pemesanan);

        $request->validate([
            'kondisi_kembali' => 'required|array',
            'denda' => 'required',
            'keterlambatan_hari' => 'required|integer|min:0',
        ]);

        // Breakdown denda per komponen
        $denda_detail = [];
        $total_denda = 0;

        $denda_map = [
            'layar' => ['rusak' => 750000],
            'kamera' => ['rusak' => 500000],
            'body' => ['rusak' => 400000],
            'kemasan' => ['hilang' => 100000],
            'charger' => ['hilang' => 500000],
        ];

        foreach($request->kondisi_kembali as $komp => $val) {
            if (isset($denda_map[$komp][$val])) {
                $denda_detail[$komp] = $denda_map[$komp][$val];
                $total_denda += $denda_map[$komp][$val];
            }
        }

        // CEK KONDISI: Jika ada komponen rusak, update status iPhone jadi "Rusak"
        $adaKerusakan = false;
        foreach ($request->kondisi_kembali as $komp => $val) {
            if ($val === 'rusak') {
                $adaKerusakan = true;
                break;
            }
        }

        // Ambil data pemesanan untuk akses id_iphone
        $pemesanan = Pemesanan::findOrFail($id_pemesanan);
        $iphone = Iphone::find($pemesanan->id_iphone);

        if ($adaKerusakan && $iphone) {
            $iphone->kondisi = 'Rusak';
            $iphone->save();
        }

        // Denda keterlambatan
        $denda_keterlambatan = 0;
        if ($request->keterlambatan_hari > 0) {
            $denda_keterlambatan = $request->keterlambatan_hari * 600000;
            $total_denda += $denda_keterlambatan;
        }

        Pengembalian::updateOrCreate(
            ['id_pemesanan' => $id_pemesanan],
            [
                'tanggal_kembali_real' => now(),
                'kondisi_kembali' => $request->input('kondisi_kembali'),
                'denda' => $total_denda,
                'denda_detail' => $denda_detail,
                'denda_keterlambatan' => $denda_keterlambatan,
                'status_bayar' => ($total_denda > 0 ? 'belum' : 'lunas'),
                'status_pengembalian' => 'diperiksa',
                'keterlambatan_hari' => $request->input('keterlambatan_hari'),
            ]   
        );

        // Status iPhone tetap "Disewa" sampai penyewa konfirmasi
        return redirect()->route('admin.dashboard-admin')->with('success', 'Pemeriksaan pengembalian berhasil!');
    }
}