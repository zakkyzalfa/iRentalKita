<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iphone;

class HomeController extends Controller
{
    public function index()
    {
        // Urutan flagship, tipe tertinggi ke terendah
        $tipeOrder = [
            'iphone 16 pro max', 'iphone 16 pro', 'iphone 16',
            'iphone 15 pro max', 'iphone 15 pro', 'iphone 15', 'iphone 15 plus',
            'iphone 14 pro max', 'iphone 14 pro', 'iphone 14', 'iphone 14 plus',
            'iphone 13 pro max', 'iphone 13 pro', 'iphone 13', 'iphone 13 mini',
            'iphone 12 pro max', 'iphone 12 pro', 'iphone 12', 'iphone 12 mini',
            'iphone 11 pro max', 'iphone 11 pro', 'iphone 11'
        ];

        // Ambil semua iPhone tersedia, urutkan sesuai flagship, ambil 4 teratas
        $iphones = Iphone::where('status', 'tersedia')->get()->sortBy(function($item) use ($tipeOrder) {
            $index = array_search(strtolower($item->tipe_iphone), $tipeOrder);
            return $index === false ? 999 : $index;
        })->take(4);

        return view('pages.home', compact('iphones'));
    }
}