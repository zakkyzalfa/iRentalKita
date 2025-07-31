<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iphone;

class IphoneController extends Controller
{
    public function index()
    {
        $iphones = Iphone::all();
        return view('pages.daftar-iphone', compact('iphones'));
    }
}
