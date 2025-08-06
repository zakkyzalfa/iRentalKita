<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Iphone;
use App\Models\Pengambilan;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    // ... function lain ...

    public function prosesKonfirmasiPengambilan(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['iphone', 'pembayaran'])->findOrFail($id_pemesanan);

        // Update status iPhone
        $iphone = $pemesanan->iphone;
        $iphone->status = 'Disewa';
        $iphone->save();

        // Ambil kondisi awal dari iPhone
        $kondisi_awal = $iphone->kondisi; // pastikan kolom 'kondisi' ada di tabel iphones

        // Simpan ke tabel pengambilans
        Pengambilan::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'tanggal_pengambilan' => now(),
            'kondisi_awal' => $kondisi_awal,
        ]);

        $metode = $pemesanan->pembayaran->metode_bayar ?? null;

        if ($metode === 'Transfer Bank') {
            return redirect()->route('dashboard-penyewa')->with('sukses_pengambilan', true);
        } else {
            return redirect()->route('bukti.pembayaran', $pemesanan->pembayaran->id_pembayaran ?? 0)
                             ->with('sukses_pengambilan', true);
        }
    }
}