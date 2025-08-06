<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    // Tampil list penyewa
    public function index()
    {
        $penyewas = Penyewa::all();
        return view('admin.manajemen-penyewa', compact('penyewas'));
    }

    // Detail penyewa
    public function show($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        return view('admin.detail-penyewa', compact('penyewa'));
    }

    // Hapus penyewa
    public function destroy($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->delete();

        // Jika request AJAX (fetch), return JSON:
        if(request()->expectsJson()){
            return response()->json(['success' => true]);
        }
        // Jika biasa, redirect saja
        return redirect()->route('admin.manajemen-penyewa')->with('success', 'Penyewa berhasil dihapus');
    }
}