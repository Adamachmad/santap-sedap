@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Pesanan #{{ $transaksi->id_transaksi }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        {{-- Kolom Kiri: Detail Item Pesanan --}}
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    Item yang Dipesan
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailPesanan as $item)
                            <tr>
                                <td>{{ $item['nama_menu'] }}</td>
                                <td class="text-center">{{ $item['quantity'] }}</td>
                                <td class="text-end">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Harga:</th>
                                <th class="text-end">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Informasi & Aksi --}}
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    Informasi & Aksi
                </div>
                <div class="card-body">
                    <p><strong>Pemesan:</strong> {{ $transaksi->user->name }}</p>
                    <p><strong>Email:</strong> {{ $transaksi->user->email }}</p>
                    <p><strong>Tanggal Pesan:</strong> {{ $transaksi->created_at->format('d M Y, H:i') }}</p>
                    <hr>
                    <form action="{{ route('admin.pesanan.updateStatus', $transaksi->id_transaksi) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status Pesanan</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $transaksi->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $transaksi->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $transaksi->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection