<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function showForm($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone'])->findOrFail($id_pemesanan);

        $tanggal_sewa = \Carbon\Carbon::parse($pemesanan->tanggal_sewa);
        $tanggal_kembali = \Carbon\Carbon::parse($pemesanan->tanggal_kembali);
        $durasi = $tanggal_sewa->diffInDays($tanggal_kembali);
        $total = $durasi * $pemesanan->iphone->harga_per_hari;

        return view('penyewa.pembayaran', [
            'pemesanan' => $pemesanan,
            'durasi' => $durasi,
            'total' => $total
        ]);
    }

    // AJAX handler
    public function proses(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone'])->findOrFail($id_pemesanan);

        $validated = $request->validate([
            'metode_pembayaran' => 'required|in:cash,bank'
        ]);

        $total = (\Carbon\Carbon::parse($pemesanan->tanggal_sewa)
            ->diffInDays(\Carbon\Carbon::parse($pemesanan->tanggal_kembali)))
            * $pemesanan->iphone->harga_per_hari;

        if ($request->metode_pembayaran === 'bank') {
            $pembayaran = Pembayaran::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'total_bayar'  => $total,
                'metode_bayar' => 'Transfer Bank',
                'bukti_bayar'  => null,
                'status'       => 'Lunas',
            ]);
            return response()->json([
                'success' => true,
                'redirect' => route('bukti.pembayaran', $pembayaran->id_pembayaran)
            ]);
        }

        // TUNAI: Data pembayaran langsung masuk, status "Belum Bayar"
        $pembayaran = Pembayaran::create([
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'total_bayar'  => $total,
            'metode_bayar' => 'Tunai',
            'status'       => 'Belum Bayar',
            'bukti_bayar'  => null
        ]);
        return response()->json([
            'success' => true,
            'redirect' => route('konfirmasi.pengambilan', $pemesanan->id_pemesanan)
        ]);
    }

    // Method untuk menampilkan bukti pembayaran
    public function bukti($id_pembayaran)
    {
        $pembayaran = Pembayaran::with(['pemesanan.penyewa', 'pemesanan.iphone'])->findOrFail($id_pembayaran);
        $pemesanan = $pembayaran->pemesanan;
        $penyewa = $pemesanan ? $pemesanan->penyewa : null;
        $iphone = $pemesanan ? $pemesanan->iphone : null;

        $durasi = null;
        if ($pemesanan && $pemesanan->tanggal_sewa && $pemesanan->tanggal_kembali) {
            $durasi = \Carbon\Carbon::parse($pemesanan->tanggal_sewa)
                ->diffInDays(\Carbon\Carbon::parse($pemesanan->tanggal_kembali));
        }

        return view('penyewa.bukti-pembayaran', [
            'pembayaran' => $pembayaran,
            'pemesanan' => $pemesanan,
            'penyewa' => $penyewa,
            'iphone' => $iphone,
            'durasi' => $durasi,
        ]);
    }
}