@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <h1 class="page-title mb-4 text-center">PENGATURAN PROFIL</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        {{-- Memanggil form untuk update info profil --}}
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        {{-- Memanggil form untuk update password --}}
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection