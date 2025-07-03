<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Santap Sedap - Autentikasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #f8f9fa;">
    <div id="app">
        {{-- Navbar Kustom --}}
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">SANTAPSEDAP</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        @if(Route::currentRouteName() == 'register')
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Konten Utama (Form Login/Register) --}}
        <main class="auth-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        
        {{-- Footer Kustom --}}
        <footer class="footer-custom fixed-bottom">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-4"><i class="bi bi-instagram"></i> <a href="#">@santapsedap_</a></div>
                    <div class="col-md-4"><i class="bi bi-facebook"></i> <a href="#">@santapsedap01</a></div>
                    <div class="col-md-4"><i class="bi bi-envelope-fill"></i> <a href="mailto:santapsedap01@gmail.com">santapsedap01@gmail.com</a></div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>