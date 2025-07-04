<section>
    <header>
        <h2 class="h5 font-weight-bold">
            Ubah Password
        </h2>
        <p class="mt-1 text-muted">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Password Saat Ini</label>
            <input id="current_password" name="current_password" type="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input id="password" name="password" type="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-success">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>