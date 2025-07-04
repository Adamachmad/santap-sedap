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
                'quantity' => 'required|numeric|min:1'
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
    $cart = session()->get('cart', []);
    $total = 0;

    // Hitung total harga
    if(is_array($cart) || is_object($cart)){
        foreach ($cart as $id => $details) {
            $total += $details['harga'] * $details['quantity'];
        }
    }

    // Buat transaksi baru
    Transaksi::create([
        'user_id' => auth()->user()->id, // <-- GANTI DARI 'customer_id' MENJADI 'user_id'
        'total_harga' => $total,
        'pesanan' => json_encode($cart), // Simpan detail keranjang sebagai JSON
        'status' => 'pending', // Status awal pesanan
    ]);

    // Kosongkan keranjang
    session()->forget('cart');

    return redirect()->route('order.success')->with('success', 'Pesanan Anda telah berhasil dibuat!');
}
}