<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($request->username === 'admin' && $request->password === 'admin123') {
            // Set session login admin
            session(['is_admin_logged_in' => true]);
            return redirect()->route('login-admin')
                ->with('admin_success', 'Login sebagai petugas admin berhasil');
        } else {
            // Pastikan session dihapus jika gagal login
            session()->forget('is_admin_logged_in');
            return redirect()->route('login-admin')
                ->with('admin_error', 'Login gagal, username atau password salah');
        }
    }
}