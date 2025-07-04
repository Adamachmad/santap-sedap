<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data statistik.
     */
    public function dashboard()
    {
        $totalPendapatan = Transaksi::where('status', 'completed')->sum('total_harga');
        $totalPesanan = Transaksi::count();
        $totalPelanggan = User::where('role', 'user')->count();

        return view('admin.dashboard', [
            'totalPendapatan' => $totalPendapatan,
            'totalPesanan' => $totalPesanan,
            'totalPelanggan' => $totalPelanggan,
        ]);
    }

    /**
     * Menampilkan halaman daftar menu.
     */
    public function indexMenu()
    {
        $menus = Menu::latest()->get();
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
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('menu-images', 'public');
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $pathGambar,
            'user_id' => auth()->id(),
        ]);

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menu-images', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Menghapus data menu dari database.
     */
    public function destroyMenu(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    /**
     * Menampilkan halaman daftar pesanan.
     */
    public function indexPesanan()
    {
        $transaksis = Transaksi::with('user')->latest()->get();
        return view('admin.pesanan.index', ['transaksis' => $transaksis]);
    }

    /**
     * Menampilkan halaman detail untuk satu pesanan.
     */
    public function showPesanan(Transaksi $transaksi)
    {
        $transaksi->load('user');
        $detailPesanan = json_decode($transaksi->pesanan, true);

        return view('admin.pesanan.show', [
            'transaksi' => $transaksi,
            'detailPesanan' => $detailPesanan,
        ]);
    }

    /**
     * Mengupdate status pesanan.
     */
    public function updateStatusPesanan(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }
}