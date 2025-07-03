@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="page-title mb-4">PESANAN SAYA</h1>

    <ul class="nav nav-tabs order-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="dikemas-tab" data-bs-toggle="tab" data-bs-target="#dikemas" type="button">Dikemas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dikirim-tab" data-bs-toggle="tab" data-bs-target="#dikirim" type="button">Dikirim</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button">Selesai</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dibatalkan-tab" data-bs-toggle="tab" data-bs-target="#dibatalkan" type="button">Dibatalkan</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        {{-- Tab untuk status 'pending' (Dikemas) --}}
        <div class="tab-pane fade show active" id="dikemas" role="tabpanel">
            @forelse ($transaksis->where('status', 'pending') as $order)
                @include('pesanan.partials.order_card', ['order' => $order])
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-box-seam" style="font-size: 5rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Belum ada pesanan yang sedang dikemas.</p>
                </div>
            @endforelse
        </div>

        {{-- Tab untuk status 'processing' (Dikirim) --}}
        <div class="tab-pane fade" id="dikirim" role="tabpanel">
             @forelse ($transaksis->where('status', 'processing') as $order)
                @include('pesanan.partials.order_card', ['order' => $order])
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-truck" style="font-size: 5rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Belum ada pesanan yang sedang dikirim.</p>
                </div>
            @endforelse
        </div>

        {{-- Tab untuk status 'completed' (Selesai) --}}
        <div class="tab-pane fade" id="selesai" role="tabpanel">
             @forelse ($transaksis->where('status', 'completed') as $order)
                @include('pesanan.partials.order_card', ['order' => $order])
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-clipboard-check-fill" style="font-size: 5rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Belum ada pesanan yang selesai.</p>
                </div>
            @endforelse
        </div>

        {{-- Tab untuk status 'cancelled' (Dibatalkan) --}}
        <div class="tab-pane fade" id="dibatalkan" role="tabpanel">
             @forelse ($transaksis->where('status', 'cancelled') as $order)
                @include('pesanan.partials.order_card', ['order' => $order])
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-x-circle" style="font-size: 5rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Tidak ada pesanan yang dibatalkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection