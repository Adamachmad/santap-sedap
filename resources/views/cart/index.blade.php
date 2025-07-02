@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Keranjang Belanja Anda</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach((array) session('cart') as $id => $details)
                    @php $total += $details['harga'] * $details['quantity']; @endphp
                    <tr>
                        <td>{{ $details['nama_menu'] }}</td>
                        <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                        <td style="width: 150px;">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control form-control-sm" min="1">
                                    <button type="submit" class="btn btn-secondary btn-sm">Update</button>
                                </div>
                            </form>
                        </td>
                        <td>Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
            <a href="#" class="btn btn-primary mt-3">Lanjut ke Checkout</a>
        </div>

    @else
        <div class="text-center">
            <p>Keranjang Anda masih kosong.</p>
            <a href="{{ route('menu') }}" class="btn btn-primary">Lihat Menu</a>
        </div>
    @endif
</div>
@endsection