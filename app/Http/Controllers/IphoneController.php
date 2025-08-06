<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iphone;

class IphoneController extends Controller
{
    public function index(Request $request)
    {
        $query = Iphone::query();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter warna
        if ($request->filled('color')) {
            $query->where('warna', $request->color);
        }

        // Search tipe iphone
        if ($request->filled('q')) {
            $query->where('tipe_iphone', 'like', '%' . $request->q . '%');
        }

        $iphones = $query->orderBy('id_iphone', 'desc')->get();

        // Statistik untuk header
        $totalIphone = Iphone::count();
        $tersedia    = Iphone::where('status', 'tersedia')->count();
        $disewa      = Iphone::where('status', 'disewa')->count();
        $rusak       = Iphone::where('kondisi', 'rusak')->count();

        // Semua warna unik untuk filter
        $allColors = Iphone::select('warna')->distinct()->pluck('warna');

        return view('admin.manajemen-iphone', compact(
            'iphones',
            'totalIphone',
            'tersedia',
            'disewa',
            'rusak',
            'allColors'
        ));
    }

    // Untuk laman publik
    public function daftar(Request $request)
    {
        $query = Iphone::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('warna')) {
            $query->where('warna', $request->warna);
        }
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where('tipe_iphone', 'like', '%'.$search.'%');
        }

        $iphones = $query->get();
        $allColors = Iphone::select('warna')->distinct()->pluck('warna');

        return view('pages.daftar-iphone', compact('iphones', 'allColors'));
    }

    public function show($id_iphone)
    {
        $iphone = Iphone::findOrFail($id_iphone);
        return view('pages.detail-iphone', compact('iphone'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_iphone'     => 'required|string|max:100',
            'imei'            => 'required|string|max:100|unique:iphones,imei',
            'warna'           => 'required|string|max:50',
            'status'          => 'required|in:tersedia,disewa,maintenance',
            'kondisi'         => 'required|in:baik,rusak',
            'harga_per_hari'  => 'required|numeric|min:0',
            'gambar'          => 'nullable|url',
        ]);
        Iphone::create($request->all());

        return redirect()->route('admin.iphones.index')->with('success', 'iPhone berhasil ditambahkan!');
    }

    public function update(Request $request, $id_iphone)
    {
        $iphone = Iphone::findOrFail($id_iphone);

        $request->validate([
            'tipe_iphone'     => 'required|string|max:100',
            'imei'            => 'required|string|max:100|unique:iphones,imei,'.$iphone->id_iphone.',id_iphone',
            'warna'           => 'required|string|max:50',
            'status'          => 'required|in:tersedia,disewa,maintenance',
            'kondisi'         => 'required|in:baik,rusak',
            'harga_per_hari'  => 'required|numeric|min:0',
            'gambar'          => 'nullable|url',
        ]);
        $iphone->update($request->all());

        return redirect()->route('admin.iphones.index')->with('success', 'iPhone berhasil diupdate!');
    }

    public function destroy($id_iphone)
    {
        $iphone = Iphone::findOrFail($id_iphone);
        $iphone->delete();
        return redirect()->route('admin.iphones.index')->with('success', 'iPhone berhasil dihapus!');
    }
}