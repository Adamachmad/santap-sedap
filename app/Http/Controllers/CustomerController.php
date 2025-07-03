<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Menampilkan halaman utama (beranda) untuk pelanggan.
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Menampilkan halaman menu untuk pelanggan.
     */
    public function menu()
    {
        // Mengambil semua menu dan langsung mengelompokkannya berdasarkan kategori
        $menus = Menu::all()->groupBy('kategori');

        return view('menu', ['menus' => $menus]);
    }

    /**
     * Menampilkan halaman riwayat pesanan untuk pengguna yang login.
     */
        public function riwayatPesanan()
        {
            // UBAH NAMA VARIABEL INI dari $pesanan menjadi $transaksis
            $transaksis = Transaksi::where('user_id', auth()->id())->latest()->get();

            // KIRIM VARIABEL $transaksis ke view
            return view('pesanan.index', ['transaksis' => $transaksis]);
        }
}