<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // <-- TAMBAHKAN INI untuk memanggil model Menu

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Menampilkan halaman daftar menu.
     * Ini method baru yang kita tambahkan.
     */
    public function indexMenu()
    {
        // Mengambil semua data dari tabel menu
        $menus = Menu::all();

        // Mengirim data menu ke view
        return view('admin.menu.index', ['menus' => $menus]);
    }
    public function createMenu()
    {
        // Menampilkan form untuk membuat menu baru
    return view('admin.menu.create');
    }
    public function editMenu(Menu $menu)
{
    // Laravel secara otomatis akan mencari menu berdasarkan id
    return view('admin.menu.edit', ['menu' => $menu]);
}
public function updateMenu(Request $request, Menu $menu)
{
    // 1. Validasi data
    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'kategori' => 'required|string',
        'harga' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
    ]);

    // 2. Update data di database
    $menu->update([
        'nama_menu' => $request->nama_menu,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
    ]);

    // 3. Redirect kembali dengan pesan sukses
    return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate!');
}

    public function storeMenu(Request $request)
    {
    // 1. Validasi data input
    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'kategori' => 'required|string',
        'harga' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
    ]);

    // 2. Simpan data ke database
    $menu = new Menu();
    $menu->nama_menu = $request->nama_menu;
    $menu->kategori = $request->kategori;
    $menu->harga = $request->harga;
    $menu->deskripsi = $request->deskripsi;
    // Asumsi admin_id untuk sementara adalah 1
    // Nanti ini akan disesuaikan dengan admin yang sedang login
    $menu->admin_id = 1; 
    $menu->save();

    // 3. Redirect kembali ke halaman daftar menu dengan pesan sukses
    return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
}

    /**
     * Menghapus menu berdasarkan ID.
     */
public function destroyMenu(Menu $menu)
{
    // Hapus data dari database
    $menu->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
}
}