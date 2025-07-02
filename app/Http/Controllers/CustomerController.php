<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CustomerController extends Controller
{
    /**
     * Menampilkan halaman utama (beranda) untuk pelanggan.
     */
    public function home()
    {
        // Untuk saat ini, kita hanya menampilkan view.
        // Nanti kita bisa tambahkan data menu favorit, dll.
        return view('home');
    }
    public function menu()
{
    // Ambil semua data dari tabel menu
    $menus = Menu::all();

    // Kirim data ke view 'menu'
    return view('menu', ['menus' => $menus]);
}
}