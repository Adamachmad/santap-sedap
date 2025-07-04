@php
    // Ambil detail pesanan dari kolom JSON
    $detailPesanan = json_decode($order->pesanan, true);
    // Ambil item pertama untuk ditampilkan sebagai preview
    $firstItem = !empty($detailPesanan) ? array_values($detailPesanan)[0] : null;
    // Hitung total item
    $totalItems = count($detailPesanan);
@endphp

<div class="order-card">
    @if ($firstItem)
        <div class="d-flex align-items-center order-item-preview">
            <img src="{{ $firstItem['gambar'] ? asset('storage/' . $firstItem['gambar']) : 'https://picsum.photos/id/'.($order->id_transaksi).'/60' }}" alt="{{ $firstItem['nama_menu'] }}">
            <div class="ms-3">
                <h6 class="mb-0 fw-bold">{{ $firstItem['nama_menu'] }}</h6>
                <p class="mb-0 text-muted">x{{ $firstItem['quantity'] }}</p>
            </div>
        </div>
        @if ($totalItems > 1)
            <small class="text-muted d-block mt-2">dan {{ $totalItems - 1 }} produk lainnya...</small>
        @endif
    @endif
    
    <hr>
    
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span>Total {{ $totalItems }} produk</span>
            <strong class="ms-3">Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
        </div>
        <div>
            {{-- TOMBOL DETAIL DITAMBAHKAN DI SINI --}}
            <a href="{{ route('pesanan.show', $order->id_transaksi) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
        </div>
    </div>
</div>