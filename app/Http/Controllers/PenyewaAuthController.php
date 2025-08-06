<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PenyewaAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.pendaftaran');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
            'email' => 'required|email|unique:penyewas,email',
            'password' => 'required|min:8|confirmed',
            'alamat' => 'required|min:10|max:100',
            'no_hp' => 'required|regex:/^08[0-9]{8,11}$/|max:15',
            'no_ktp' => 'required|digits_between:16,20|unique:penyewas,no_ktp',
        ]);

        Penyewa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'tanggal_daftar' => now()->toDateString(),
        ]);

        // Redirect ke halaman pendaftaran, bukan langsung ke login!
        return redirect()->route('pendaftaran')->with('success', 'Pendaftaran berhasil, silakan login.');
    }

    public function showLoginForm()
    {
        return view('auth.login-penyewa');
    }

    public function login(Request $request)
    {
        // Validasi dulu
        $credentials = $request->only('email', 'password');
        if (Auth::guard('penyewa')->attempt($credentials)) {
            // Berhasil login, jangan langsung redirect ke home!
            return redirect()->route('login-penyewa')->with('success', 'Anda berhasil Masuk, Sekarang anda bisa menyewa iPhone');
        } else {
            // Gagal login
            return back()->withErrors([
                'email' => 'Email atau Password salah, silahkan coba lagi',
            ])->withInput();
        }
    }

    public function updateProfile(Request $request)
    {
        $penyewa = Auth::guard('penyewa')->user();

        $request->validate([
            'nama' => 'required|min:3|max:50',
            'email' => 'required|email|unique:penyewas,email,' . $penyewa->id_penyewa . ',id_penyewa',
            'no_hp' => 'required|regex:/^08[0-9]{8,11}$/|max:15',
            'alamat' => 'required|min:10|max:100',
            'no_ktp' => 'required|digits_between:16,20|unique:penyewas,no_ktp,' . $penyewa->id_penyewa . ',id_penyewa',
        ]);

        $penyewa->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
        ]);

        return redirect()->route('dashboard-penyewa')->with('success', 'Profile berhasil diperbarui!');
    }

    public function logout()
    {
        Auth::guard('penyewa')->logout();
        return redirect()->route('home');
    }
}