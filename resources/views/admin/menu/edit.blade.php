@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Menu: {{ $menu->nama_menu }}</h1>
    <p class="mb-4">Ubah data pada form di bawah ini untuk mengedit item menu.</p>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Method spoofing untuk request UPDATE --}}

                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{ $menu->nama_menu }}" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="Makanan" {{ $menu->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="Cemilan" {{ $menu->kategori == 'Cemilan' ? 'selected' : '' }}>Cemilan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $menu->harga }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $menu->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Menu</button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection