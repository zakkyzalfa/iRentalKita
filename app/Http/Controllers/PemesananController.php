<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Iphone;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengambilan;

class PemesananController extends Controller
{
    // Proses pemesanan dari detail iPhone
    public function store(Request $request, $id_iphone)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa'
        ], [
            'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal mulai.'
        ]);

        $penyewa = Auth::user();

        $pemesanan = Pemesanan::create([
            'id_penyewa' => $penyewa->id_penyewa,
            'id_iphone' => $id_iphone,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        $redirectUrl = route('pembayaran.show', $pemesanan->id_pemesanan);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['redirect' => $redirectUrl]);
        }

        return redirect($redirectUrl)->with('success', 'Pemesanan berhasil, silahkan lanjut ke pembayaran');
    }

    // Halaman pembayaran
    public function pembayaran($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone', 'pembayaran'])->findOrFail($id_pemesanan);

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

    // Halaman konfirmasi pengambilan
    public function konfirmasiPengambilan($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone', 'pembayaran'])->findOrFail($id_pemesanan);

        $tanggal_sewa = \Carbon\Carbon::parse($pemesanan->tanggal_sewa);
        $tanggal_kembali = \Carbon\Carbon::parse($pemesanan->tanggal_kembali);
        $durasi = $tanggal_sewa->diffInDays($tanggal_kembali);
        $total = $durasi * $pemesanan->iphone->harga_per_hari;

        $status_pembayaran = '-';
        if ($pemesanan->pembayaran) {
            if ($pemesanan->pembayaran->metode_bayar == 'Transfer Bank') {
                $status_pembayaran = 'Berhasil';
            } elseif ($pemesanan->pembayaran->metode_bayar == 'Tunai') {
                $status_pembayaran = $pemesanan->pembayaran->status ?? 'Belum Bayar';
            }
        }

        return view('penyewa.konfirmasi-pengambilan', [
            'pemesanan' => $pemesanan,
            'durasi' => $durasi,
            'total' => $total,
            'status_pembayaran' => $status_pembayaran
        ]);
    }

    // Proses konfirmasi pengambilan
    public function prosesKonfirmasiPengambilan(Request $request, $id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['iphone', 'pembayaran'])->findOrFail($id_pemesanan);

        // Update status iPhone
        $iphone = $pemesanan->iphone;
        $iphone->status = 'Disewa';
        $iphone->save();

        // Cegah duplikasi pengambilan
        $cekPengambilan = Pengambilan::where('id_pemesanan', $pemesanan->id_pemesanan)->first();
        if (!$cekPengambilan) {
            Pengambilan::create([
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'tanggal_pengambilan' => now(),
                'kondisi_awal' => $iphone->kondisi
            ]);
        }

        // Jika pembayaran tunai, update status pembayaran jadi "Lunas"
        if ($pemesanan->pembayaran && $pemesanan->pembayaran->metode_bayar == 'Tunai') {
            $pemesanan->pembayaran->status = 'Lunas';
            $pemesanan->pembayaran->save();
        }

        $metode = $pemesanan->pembayaran->metode_bayar ?? null;

        if ($metode === 'Transfer Bank') {
            return redirect()->route('dashboard-penyewa')->with('sukses_pengambilan', true);
        } else {
            return redirect()->route('bukti.pembayaran', $pemesanan->pembayaran->id_pembayaran ?? 0)
                            ->with('sukses_pengambilan', true);
        }
    }

    public function showKonfirmasiPengembalian($id_pemesanan)
    {
        $pemesanan = Pemesanan::with(['penyewa', 'iphone', 'pengembalian', 'pembayaran'])->findOrFail($id_pemesanan);

        $tanggal_sewa = \Carbon\Carbon::parse($pemesanan->tanggal_sewa);
        $tanggal_kembali = \Carbon\Carbon::parse($pemesanan->tanggal_kembali);
        $durasi = $tanggal_sewa->diffInDays($tanggal_kembali);

        return view('penyewa.konfirmasi-pengembalian', compact('pemesanan', 'durasi'));
    }
}