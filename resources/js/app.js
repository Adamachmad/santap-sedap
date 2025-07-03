// Import file bootstrap bawaan Laravel
import './bootstrap';

// Import library JavaScript Bootstrap (untuk dropdown, toast, dll.)
import 'bootstrap/dist/js/bootstrap.bundle';

// Menjalankan semua skrip setelah halaman dimuat
document.addEventListener('DOMContentLoaded', () => {

    // ======================================================
    // ==     LOGIKA UNTUK NOTIFIKASI TOAST (DARI SESSION)   ==
    // ======================================================
    const sessionDataEl = document.getElementById('session-success-data');

    if (sessionDataEl) {
        const message = sessionDataEl.getAttribute('data-message');
        const successToastEl = document.getElementById('successToast');
        const toastBody = successToastEl.querySelector('.toast-body');

        if (toastBody) {
            toastBody.textContent = message;
            const toast = new bootstrap.Toast(successToastEl);
            toast.show();
        }
    }

    // ======================================================
    // ==     LOGIKA UNTUK FILTER KATEGORI DI HALAMAN MENU   ==
    // ======================================================
    const filterButtons = document.querySelectorAll('button[data-filter]');
    const menuItems = document.querySelectorAll('.menu-item[data-category]');

    if (filterButtons.length > 0 && menuItems.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Hapus class 'active' dari semua tombol
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Tambahkan class 'active' ke tombol yang diklik
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                menuItems.forEach(item => {
                    if (filter === 'semua' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block'; // Tampilkan
                    } else {
                        item.style.display = 'none'; // Sembunyikan
                    }
                });
            });
        });
    }

});