@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Selamat Datang, {{ auth()->user()->name }}!</h6>
                    </div>
                    <div class="card-body">
                        <p>
                            Ini adalah halaman utama Dashboard Admin Santap Sedap.
                            Dari sini Anda dapat mengelola menu dan melihat pesanan masuk.
                        </p>
                        <p>Pilih menu di sidebar untuk memulai.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection