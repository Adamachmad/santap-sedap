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

    public function showMenu(Menu $menu)
    {
        // Laravel akan otomatis mencari menu berdasarkan ID dari URL
        return view('menu-detail', ['menu' => $menu]);
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
        public function showPesanan(Transaksi $transaksi)
        {
            // Otorisasi: Pastikan pengguna hanya bisa melihat pesanannya sendiri
            if (auth()->id() !== $transaksi->user_id) {
                abort(403, 'AKSES DITOLAK');
            }

            $detailPesanan = json_decode($transaksi->pesanan, true);

            return view('pesanan.show', [
                'transaksi' => $transaksi,
                'detailPesanan' => $detailPesanan,
            ]);
        }
}