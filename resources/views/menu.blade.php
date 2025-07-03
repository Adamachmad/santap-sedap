@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Menu Santap Sedap</h1>
        <p class="fs-5 text-muted">Pilih hidangan favoritmu dari daftar menu kami.</p>
    </div>
    
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        {{-- Looping untuk setiap menu dari database --}}
        @forelse ($menus as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
<!-- {{-- Cek jika ada path gambar di database, jika tidak, gunakan placeholder --}} -->
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $item->nama_menu }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_menu }}</h5>
                        <p class="card-text">{{ $item->deskripsi ?? 'Deskripsi tidak tersedia.' }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Pesan</button>
                        </form> 
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Saat ini belum ada menu yang tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection