@extends('layouts.auth_layout')

@section('title', 'Admin Login')

@section('content')
<div class="text-center mb-4">
    <h1 class="h3 mb-3 fw-normal">Santap Sedap</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <h2 class="card-title text-center mb-4 fs-5">Login Admin</h2>

        @if ($errors->any())
            <div class="alert alert-danger py-2">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                <label for="email">Email Admin</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-danger" type="submit">Masuk Admin</button>
        </form>
    </div>
</div>
@endsection