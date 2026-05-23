<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    /**
     * Menambahkan item ke keranjang belanja.
     */
    public function add(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        // Jika item sudah ada di keranjang, tambah jumlahnya
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika item belum ada, tambahkan ke keranjang
            $cart[$id] = [
                "nama_menu" => $menu->nama_menu,
                "quantity" => 1,
                "harga" => $menu->harga,
                "gambar" => $menu->gambar // Asumsi ada kolom gambar
            ];
        }

        // Simpan kembali cart ke dalam session
        session()->put('cart', $cart);

        return response()->json(['success' => 'Menu berhasil ditambahkan!']);
        }
            public function index()
        {
            $cart = session()->get('cart', []);
            return view('cart.index', ['cart' => $cart]);
        }
        public function remove($id)
        {
            $cart = session()->get('cart', []);

            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang!');
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                // MED-06: Tambahkan batas maksimum quantity untuk mencegah abuse
                'quantity' => 'required|integer|min:1|max:99'
            ]);

            $cart = session()->get('cart', []);

            if(isset($cart[$id])) {
                $cart[$id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }

            return redirect()->back()->with('success', 'Jumlah menu berhasil diupdate!');
        }
        public function checkout()
        {
        $cart = session()->get('cart', []);
        return view('cart.checkout', ['cart' => $cart]);
        }
        public function placeOrder(Request $request)
{
    // CRIT-02: Validasi field catatan untuk mencegah Stored XSS
    $request->validate([
        'catatan' => 'nullable|string|max:500',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
    }

    $total = 0;
    $verifiedCart = [];

    // HIGH-05: Verifikasi harga dari DATABASE, bukan dari session
    // Ini mencegah Price Manipulation Attack
    foreach ($cart as $id => $details) {
        $menuFromDB = \App\Models\Menu::find($id);

        if (!$menuFromDB) {
            // Item tidak valid, skip
            continue;
        }

        $verifiedQuantity = max(1, min(99, (int) $details['quantity'])); // Clamp quantity
        $verifiedHarga = $menuFromDB->harga; // Gunakan harga dari DB, BUKAN session
        $total += $verifiedHarga * $verifiedQuantity;

        // Rebuild cart data dengan harga yang sudah diverifikasi
        $verifiedCart[$id] = [
            'nama_menu' => $menuFromDB->nama_menu,
            'quantity'  => $verifiedQuantity,
            'harga'     => $verifiedHarga,
            'gambar'    => $menuFromDB->gambar,
        ];
    }

    if (empty($verifiedCart)) {
        return redirect()->route('cart.index')->with('error', 'Tidak ada item valid dalam keranjang.');
    }

    // Buat transaksi baru dengan data yang sudah diverifikasi server-side
    Transaksi::create([
        'user_id'     => auth()->user()->id,
        'total_harga' => $total,
        'pesanan'     => json_encode($verifiedCart), // Data terverifikasi dari DB
        'status'      => 'pending',
        'catatan'     => $request->catatan, // Field catatan yang sudah divalidasi
    ]);

    // Kosongkan keranjang
    session()->forget('cart');

    return redirect()->route('order.success')->with('success', 'Pesanan Anda telah berhasil dibuat!');
}
}