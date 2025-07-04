<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Santap Sedap - Nikmati Setiap Gigitan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('layouts.partials.navbar')

        <main>
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>
    
    @if (session('success'))
        <div id="session-success-data" data-message="{{ session('success') }}" style="display: none;"></div>
    @endif

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
      <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            {{-- Pesan diisi oleh app.js --}}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

</body>
</html>