@extends('layouts.app')
@section('content')
<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="display-4" style="font-family: var(--font-heading);">Menu Kami</h1>
        <p class="fs-5 text-muted">Pilih hidangan favoritmu dari daftar menu kami yang lezat.</p>
    </div>

    @if($menus->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-journal-x" style="font-size: 6rem; color: #ccc;"></i>
            <h2 class="mt-4">Menu Belum Tersedia</h2>
            <p class="text-muted">Maaf, saat ini belum ada menu yang bisa ditampilkan.</p>
        </div>
    @else
        @foreach($menus as $kategori => $items)
            <h2 class="menu-category-title">{{ $kategori }}</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                
                @foreach($items as $item)
                    <div class="col">
                        <div class="card menu-card h-100">
                            <div class="menu-card-img-wrapper">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://picsum.photos/id/'.($item->id+20).'/160' }}" class="menu-card-img" alt="{{ $item->nama_menu }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->nama_menu }}</h5>
                                <p class="card-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <div class="menu-card-actions mt-auto">
                                    <button class="btn-icon" title="Lihat Detail"><i class="bi bi-search"></i></button>
                                    <form action="{{ route('cart.add', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-icon" title="Tambah ke Keranjang"><i class="bi bi-cart-plus-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
@endsection