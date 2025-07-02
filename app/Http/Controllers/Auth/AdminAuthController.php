<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Menampilkan halaman login admin
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Memproses login admin
    public function login(Request $request)
    {
        // 1. Validasi data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard')); // Arahkan ke dashboard admin
        }

        // 3. Jika gagal, kembali ke login admin dengan pesan error
        return back()->withErrors([
            'email' => 'Kredensial tidak valid.',
        ])->onlyInput('email');
    }

    // Memproses logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form');
    }
}