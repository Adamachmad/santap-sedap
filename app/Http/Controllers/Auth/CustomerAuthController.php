<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // <-- Tambahkan ini untuk validasi password ketat

class CustomerAuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Memproses data registrasi
    public function register(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            // Gunakan array dan class Password untuk validasi kombinasi
            'password' => [
                'required',
                'confirmed',
                Password::min(8) // Minimal 8 karakter
                    ->letters()  // Harus ada huruf
                    ->mixedCase() // Harus ada huruf besar dan kecil
                    ->numbers(),  // Harus ada angka
            ],
        ]);

        // 2. Buat customer baru
        $customer = Customer::create([
            'nama_customer' => $request->nama_customer,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Login customer yang baru dibuat
        Auth::guard('web')->login($customer);

        // 4. Arahkan ke halaman utama
        return redirect()->route('home');
    }

    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // 1. Validasi data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba login menggunakan guard 'web' (untuk customer)
        if (Auth::guard('web')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home')); // Arahkan ke home setelah login
        }

        // 3. Jika gagal, kembali ke halaman login dengan pesan error untuk email dan password
        return back()->withErrors([
            'email' => 'Email yang Anda masukkan salah atau tidak terdaftar.',
            'password' => 'Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Kembali ke halaman utama
    }
}