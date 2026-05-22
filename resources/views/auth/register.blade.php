@extends('layouts.guest')

@section('content')
<div class="auth-card">
    <h2 class="auth-title">SIGN UP</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Fullname</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-danger mt-1" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger mt-1" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
            @error('password')
                <div class="text-danger mt-1" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="text-danger mt-1" style="color: red; font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-auth">Sign Up</button>
    </form>
    
    <div class="auth-links">
        <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
    </div>
</div>
@endsection