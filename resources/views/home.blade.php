@extends('layouts.app')

@section('content')
{{-- Bagian Hero --}}
<div class="container text-center py-5">
    <h1 class="display-4 fw-bold">Selamat Datang di Santap Sedap</h1>
    <p class="fs-5 text-muted col-md-8 mx-auto">Kami menyajikan hidangan terbaik dengan bahan-bahan segar pilihan, dimasak dengan cinta untuk Anda dan keluarga.</p>
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-4">
        <a href="#" class="btn btn-primary btn-lg px-4 gap-3">Lihat Menu Kami</a>
        <a href="#" class="btn btn-outline-secondary btn-lg px-4">Hubungi Kami</a>
    </div>
</div>

{{-- Bagian Menu Unggulan (Contoh) --}}
<div class="container px-4 py-5">
    <h2 class="pb-2 border-bottom text-center">Menu Unggulan Kami</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
        {{-- Nanti kita akan isi bagian ini dengan data dinamis dari database --}}
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Nasi Goreng">
                <div class="card-body">
                    <h5 class="card-title">Nasi Goreng Kampung</h5>
                    <p class="card-text">Nasi goreng klasik dengan cita rasa otentik yang tak terlupakan.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Soto Ayam">
                <div class="card-body">
                    <h5 class="card-title">Soto Ayam Lamongan</h5>
                    <p class="card-text">Kuah soto yang kaya rempah, disajikan hangat dengan suwiran ayam.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Es Teh">
                <div class="card-body">
                    <h5 class="card-title">Es Teh Manis</h5>
                    <p class="card-text">Pelepas dahaga yang sempurna untuk menemani setiap hidangan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection