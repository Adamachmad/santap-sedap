<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Santap Sedap</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex">
        <aside class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4 class="mb-4">Santap Sedap</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.menu.index') }}">Kelola Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Kelola Pesanan</a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link text-white" href="#">Logout</a>
                </li>
            </ul>
        </aside>

        <main class="w-100 p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>