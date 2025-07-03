@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- Kolom Kiri: Gambar Menu --}}
        <div class="col-md-6">
            <img src="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://picsum.photos/id/'.($menu->id).'/600/600' }}" class="img-fluid rounded shadow-sm" alt="{{ $menu->nama_menu }}">
        </div>

        {{-- Kolom Kanan: Detail & Aksi --}}
        <div class="col-md-6">
            <p class="text-muted text-uppercase">{{ $menu->kategori }}</p>
            <h1 class="display-5" style="font-family: var(--font-heading);">{{ $menu->nama_menu }}</h1>
            <h2 class="my-3" style="color: var(--primary-orange);">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h2>
            <p class="lead">{{ $menu->deskripsi ?? 'Deskripsi untuk menu ini belum tersedia.' }}</p>

            <hr class="my-4">

            <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                @csrf
                <div class="d-flex">
                    <button type="submit" class="btn btn-auth btn-lg">
                        <i class="bi bi-cart-plus-fill me-2"></i> Tambah ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection