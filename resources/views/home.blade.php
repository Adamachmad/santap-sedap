@extends('layouts.app')

@section('content')
<div class="container hero-section">
    <div class="row align-items-center">
        {{-- Kolom Kiri: Teks --}}
        <div class="col-md-6">
            <p class="text-overline">MENU UTAMA</p>
            <h1 class="display-3">NASI AYAM LALAPAN</h1>
            <p class="lead my-4">
                Tekstur renyah di bagian luar, dengan kulit renyah yang beraroma yang kontras dan melengkapi daging ayam empuk yang dikandungnya, disertai dengan lalapan dan sambal yang pedasnya nagih.
            </p>
            <a href="{{ route('menu') }}" class="btn btn-custom mt-3">Menu Lainnya</a>
        </div>
        {{-- Kolom Kanan: Gambar --}}
        <div class="col-md-6">
            <img src="{{ asset('images/ayam bagus.png') }}" class="img-fluid rounded" alt="Nasi Ayam Lalapan">
        </div>
    </div>
</div>
@endsection