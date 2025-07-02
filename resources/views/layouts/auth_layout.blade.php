<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Santap Sedap</title>
    <style>
        body {
            background-color: #f4f4f5; /* Warna background abu-abu muda */
        }
    </style>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>