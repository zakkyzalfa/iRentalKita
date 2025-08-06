<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pengembalian;
use App\Models\Iphone;
use Illuminate\Support\Facades\Auth;

class KonfirmasiPengembalianController extends Controller
{
    // Tampilkan halaman konfirmasi pengembalian
    public function show($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['iphone', 'pengembalian'])->findOrFail($id_pemesanan);

        // Hanya penyewa terkait yang boleh akses
        if (Auth::guard('penyewa')->id() !== $pemesanan->id_penyewa) {
            abort(403);
        }

        return view('penyewa.konfirmasi-pengembalian', compact('pemesanan', 'durasi'));
    }

    // Proses konfirmasi pengembalian oleh penyewa
    public function konfirmasi(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::with('pengembalian')->findOrFail($id_pemesanan);
        $pengembalian = $pemesanan->pengembalian;

        if (!$pengembalian || $pengembalian->status_pengembalian != 'diperiksa') {
            return back()->with('error', 'Pemeriksaan belum selesai.');
        }
        if ($pengembalian->denda > 0 && $pengembalian->status_bayar != 'lunas') {
            return back()->with('error', 'Denda belum dibayar.');
        }

        // Update status pengembalian dan status iPhone
        $pengembalian->status_pengembalian = 'selesai';
        $pengembalian->save();

        $iphone = $pemesanan->iphone;
        if ($pengembalian->alasan_denda && str_contains(strtolower($pengembalian->alasan_denda), 'kerusakan')) {
            $iphone->status = 'Rusak';
        } else {
            $iphone->status = 'Tersedia';
        }
        $iphone->save();

        return redirect()->route('dashboard-penyewa')->with('success', 'iPhone telah berhasil dikembalikan.');
    }

    // Proses pembayaran denda oleh penyewa
    public function bayarDenda(Request $request, $id_pemesanan)
    {
        // Validasi status dan jumlah
        $pengembalian = Pengembalian::where('id_pemesanan', $id_pemesanan)->firstOrFail();
        if($pengembalian->status_bayar == 'lunas') {
            return redirect()->back()->with('info', 'Denda sudah dibayar.');
        }

        // Proses pembayaran (anggap auto-lunas, atau sesuaikan dengan metode pembayaranmu)
        $pengembalian->update([
            'status_bayar' => 'lunas',
            'tanggal_bayar_denda' => now(),
        ]);

        return redirect()->route('konfirmasi.pengembalian', $id_pemesanan)->with('success', 'Denda berhasil dibayar!');
    }
}