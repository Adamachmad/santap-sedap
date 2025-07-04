@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title mb-0">DETAIL PESANAN</h1>
                <a href="{{ route('pesanan.riwayat') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <span>No. Pesanan: #{{ $transaksi->id_transaksi }}</span>
                    <span>Tanggal: {{ $transaksi->created_at->format('d M Y') }}</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Item yang dipesan:</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($detailPesanan as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="my-0">{{ $item['nama_menu'] }}</h6>
                                <small class="text-muted">{{ $item['quantity'] }} x Rp {{ number_format($item['harga'], 0, ',', '.') }}</small>
                            </div>
                            <span class="text-muted">Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="fw-bold">STATUS: <span class="text-uppercase">{{ $transaksi->status }}</span></span>
                    <span class="fw-bold fs-5">TOTAL: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection