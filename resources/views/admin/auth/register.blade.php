@extends('layouts.guest')

@section('content')
<div class="auth-card">
    <h2 class="auth-title">SIGN UP</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Fullname</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-auth">Sign Up</button>
    </form>
    <div class="auth-links">
        <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
    </div>
</div>
@endsection