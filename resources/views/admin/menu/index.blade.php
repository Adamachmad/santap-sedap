@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Menu</h1>
    <p class="mb-4">Berikut adalah daftar semua menu yang tersedia di Santap Sedap.</p>
            {{-- Menampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Menu Baru
    </a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Looping untuk setiap item menu dari database --}}
                        @foreach ($menus as $item)
                        <tr>
                            <td>{{ $item->nama_menu }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus menu ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection