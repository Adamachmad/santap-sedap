@extends('layouts.guest')

@section('content')
<div class="auth-card">
    <h2 class="auth-title">LOGIN</h2>

    {{-- Menampilkan error jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger p-2 mb-3">
            Email atau Password salah.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email / No.Telp</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required>
        </div>
        <div class="d-flex justify-content-end mb-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none" style="font-size: 0.9rem; color: var(--dark-text);">Forgot Password?</a>
            @endif
        </div>
        <button type="submit" class="btn btn-auth">LOGIN</button>
    </form>

    <div class="auth-links">
        <span>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></span>
    </div>
    <div class="social-login">
        <i class="bi bi-google"></i>
        <i class="bi bi-facebook"></i>
    </div>
</div>
@endsection