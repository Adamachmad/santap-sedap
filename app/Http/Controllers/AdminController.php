<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Transaksi;
class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Menampilkan halaman daftar menu.
     */
    public function indexMenu()
    {
        $menus = Menu::all();
        return view('admin.menu.index', ['menus' => $menus]);
    }

    /**
     * Menampilkan form untuk membuat menu baru.
     */
    public function createMenu()
    {
        return view('admin.menu.create');
    }

    /**
     * Menyimpan menu baru ke database.
     */
    public function storeMenu(Request $request)
{
    // 1. Validasi data input, termasuk gambar
    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'kategori' => 'required|string',
        'harga' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
    ]);

    $pathGambar = null;
    // Cek jika ada file gambar yang diupload
    if ($request->hasFile('gambar')) {
        // Simpan gambar ke folder 'public/menu-images' dan dapatkan path-nya
        $pathGambar = $request->file('gambar')->store('menu-images', 'public');
    }

    // 2. Simpan data ke database
    $menu = new Menu();
    $menu->nama_menu = $request->nama_menu;
    $menu->kategori = $request->kategori;
    $menu->harga = $request->harga;
    $menu->deskripsi = $request->deskripsi;
    $menu->gambar = $pathGambar; // Simpan path gambar ke database
    $menu->user_id = auth()->id();
    $menu->save();

    // 3. Redirect
    return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
}

    /**
     * Menampilkan form untuk mengedit menu.
     */
    public function editMenu(Menu $menu)
    {
        return view('admin.menu.edit', ['menu' => $menu]);
    }

    /**
     * Mengupdate data menu di database.
     */
    public function updateMenu(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate!');
    }
    public function indexPesanan()
    {
    // Mengambil semua data transaksi, diurutkan dari yang terbaru,
    // dan memuat data pengguna terkait (untuk nama pemesan).
    $transaksis = Transaksi::with('user')->latest()->get();

    return view('admin.pesanan.index', ['transaksis' => $transaksis]);
    }
    /**
     * Menghapus data menu dari database.
     */
    public function destroyMenu(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
    public function showPesanan(Transaksi $transaksi)
    {
    // Mengambil data pengguna dan menerjemahkan detail pesanan dari JSON
    $transaksi->load('user');
    $detailPesanan = json_decode($transaksi->pesanan, true);

    return view('admin.pesanan.show', [
        'transaksi' => $transaksi,
        'detailPesanan' => $detailPesanan,
    ]);
    }

    public function updateStatusPesanan(Request $request, Transaksi $transaksi)
    {
    // Validasi input status
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    // Update status di database
    $transaksi->status = $request->status;
    $transaksi->save();

    // Redirect kembali ke halaman detail dengan pesan sukses
    return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }
}