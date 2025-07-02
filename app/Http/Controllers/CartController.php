<?php

namespace App\Http\Controllers;

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

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
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
}