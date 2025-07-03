@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            {{-- Kolom Kiri: Daftar Pesanan --}}
            <div class="col-lg-8">
                <h1 class="page-title mb-4">DAFTAR PESANAN</h1>
                
                @foreach(session('cart') as $id => $details)
                <div class="cart-item-row">
                    <img src="{{ $details['gambar'] ? asset('storage/' . $details['gambar']) : 'https://picsum.photos/id/'.($id).'/80' }}" alt="{{ $details['nama_menu'] }}" class="cart-item-img">
                    <div class="cart-item-details">
                        <h5 class="mb-1">{{ $details['nama_menu'] }}</h5>
                        <p class="mb-1 fw-bold">Rp {{ number_format($details['harga'], 0, ',', '.') }}</p>
                        
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline-flex align-items-center">
                            @csrf
                            @method('PATCH')
                            <label for="quantity-{{$id}}" class="me-2">Beli:</label>
                            <input type="number" id="quantity-{{$id}}" name="quantity" value="{{ $details['quantity'] }}" class="form-control form-control-sm" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-secondary btn-sm ms-2">Update</button>
                        </form>
                    </div>
                    
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-icon text-danger" title="Hapus Item"><i class="bi bi-trash-fill fs-5"></i></button>
                    </form>
                </div>
                @endforeach
            </div>

            {{-- Kolom Kanan: Detail Pesanan --}}
            <div class="col-lg-4">
                {{-- Ganti class di sini --}}
                <div class="auth-card">
                    <h4 class="mb-3 auth-title" style="font-size: 1.5rem;">DETAIL PESANAN</h4>
                    @php $total = 0; @endphp
                    @foreach((array) session('cart') as $id => $details)
                        @php $total += $details['harga'] * $details['quantity']; @endphp
                    @endforeach
                    @php $ongkir = 7000; @endphp

                    <div class="d-flex justify-content-between">
                        <span>Sub Total</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Ongkir</span>
                        <span>Rp. {{ number_format($ongkir, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <p class="fw-bold">METODE PEMBAYARAN</p>
                    <div class="payment-method">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">Bayar Di tempat (COD)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="transfer">
                            <label class="form-check-label" for="transfer">Transfer antar virtual</label>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span>Rp. {{ number_format($total + $ongkir, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('cart.checkout') }}" class="btn btn-auth w-100 mt-3">PESAN SEKARANG</a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x-fill" style="font-size: 6rem; color: #ccc;"></i>
            <h2 class="mt-4">Keranjang Anda Kosong</h2>
            <p class="text-muted">Sepertinya Anda belum memilih menu apapun.</p>
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg mt-3">Lihat Menu</a>
        </div>
    @endif
</div>
@endsection