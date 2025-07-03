@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Konfirmasi Pesanan</h1>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Pesanan</h5>
                    <ul class="list-group list-group-flush">
                        @php $total = 0; @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['harga'] * $details['quantity']; @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $details['nama_menu'] }} (x{{ $details['quantity'] }})
                                <span>Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            Total Pembayaran
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </li>
                    </ul>

                    <hr>

                    <h5 class="card-title mt-4">Data Pemesan</h5>
                    {{-- Form ini akan kita buat berfungsi di langkah selanjutnya --}}
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
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Buat Pesanan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection