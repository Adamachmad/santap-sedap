@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="page-title text-center mb-4">Konfirmasi Pesanan</h1>
            
            {{-- Ganti class di sini --}}
            <div class="auth-card"> 
                <h4 class="summary-title">Ringkasan Pesanan</h4>
                <ul class="list-group list-group-flush mb-4 bg-transparent">
                    @php $total = 0; @endphp
                    @foreach((array) session('cart') as $id => $details)
                        @php $total += $details['harga'] * $details['quantity']; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            {{ $details['nama_menu'] }} (x{{ $details['quantity'] }})
                            <span>Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 fw-bold fs-5 bg-transparent">
                        Total Pembayaran
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </li>
                </ul>

                <h4 class="summary-title mt-5">Data Pemesan</h4>
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_customer" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_customer" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email_customer" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_customer" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Contoh: Sambal dipisah, jangan terlalu pedas."></textarea>
                    </div>
                    <button type="submit" class="btn btn-auth w-100 mt-3">Buat Pesanan Sekarang</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection