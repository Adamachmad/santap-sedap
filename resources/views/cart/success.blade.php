@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4 text-success">Terima Kasih!</h1>
            <p class="lead">Pesanan Anda telah berhasil kami terima dan akan segera diproses.</p>
            <hr>
            <p>
                Ingin memesan lagi?
            </p>
            <a href="{{ route('menu') }}" class="btn btn-primary">Kembali ke Menu</a>
        </div>
    </div>
</div>
@endsection