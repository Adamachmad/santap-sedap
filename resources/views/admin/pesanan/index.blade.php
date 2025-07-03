@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Pesanan Masuk</h1>
    <p class="mb-4">Berikut adalah daftar semua transaksi yang telah dilakukan oleh pelanggan.</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pemesan</th>
                            <th>Tanggal Pesan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->user->name }}</td>
                            <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if($transaksi->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($transaksi->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-info">{{ $transaksi->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pesanan.show', $transaksi->id_transaksi) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pesanan yang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection