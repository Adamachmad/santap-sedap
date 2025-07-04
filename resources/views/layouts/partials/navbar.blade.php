<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            SANTAPSEDAP
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu') }}">Menu</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pesanan.riwayat') }}">Pesanan</a>
                </li>
                @endauth
                
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                @endguest

                {{-- Dropdown untuk Keranjang --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbar-cart-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cart-fill fs-4"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" style="font-size: 0.6em;">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                
                    <div class="dropdown-menu dropdown-menu-end mini-cart-dropdown" aria-labelledby="cartDropdown">
                        @if(session('cart') && count(session('cart')) > 0)
                            <h6 class="dropdown-header">Isi Keranjang</h6>
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['harga'] * $details['quantity']; @endphp
                                <div class="mini-cart-item px-2">
                                    <img src="{{ $details['gambar'] ? asset('storage/' . $details['gambar']) : 'https://picsum.photos/id/'.($id).'/50' }}" alt="{{ $details['nama_menu'] }}">
                                    <div class="mini-cart-item-details">
                                        <div class="fw-bold">{{ $details['nama_menu'] }}</div>
                                        <small>{{ $details['quantity'] }} x Rp {{ number_format($details['harga'], 0, ',', '.') }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <hr class="dropdown-divider">
                            <div class="px-2">
                                <div class="d-flex justify-content-between fw-bold mb-2">
                                    <span>Total:</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('cart.index') }}" class="btn btn-custom w-100 mb-2">Lihat Keranjang</a>
                                <a href="{{ route('cart.checkout') }}" class="btn btn-auth w-100">Checkout</a>
                            </div>
                        @else
                            <p class="text-center text-muted px-3">Keranjang Anda kosong.</p>
                        @endif
                    </div>
                </li>

                 @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=E86A33" width="32" height="32" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                             @if (auth()->user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>