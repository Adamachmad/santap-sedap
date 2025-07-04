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
    // ======================================================
    // ==         LOGIKA UNTUK ANIMASI FLY-TO-CART         ==
    // ======================================================
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const navbarCart = document.getElementById('navbar-cart-icon');

    if (addToCartButtons.length > 0 && navbarCart) {
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // 1. Ambil info dari tombol yang diklik
                const addToCartUrl = this.dataset.url;
                const sourceImgSrc = this.dataset.imgSrc;
                const sourceImg = this.closest('.menu-card').querySelector('.menu-card-img');
                
                // 2. Buat duplikat gambar
                const flyingImg = document.createElement('img');
                flyingImg.src = sourceImgSrc;
                flyingImg.classList.add('fly-to-cart-img');
                
                // 3. Atur posisi awal duplikat (tepat di atas gambar asli)
                const sourceRect = sourceImg.getBoundingClientRect();
                flyingImg.style.left = `${sourceRect.left}px`;
                flyingImg.style.top = `${sourceRect.top}px`;
                flyingImg.style.width = `${sourceRect.width}px`;
                flyingImg.style.height = `${sourceRect.height}px`;

                document.body.appendChild(flyingImg);

                // 4. Atur posisi akhir (di atas ikon keranjang navbar)
                const targetRect = navbarCart.getBoundingClientRect();
                
                // Sedikit timeout agar transisi CSS bisa berjalan
                setTimeout(() => {
                    flyingImg.style.left = `${targetRect.left + 15}px`;
                    flyingImg.style.top = `${targetRect.top + 10}px`;
                    flyingImg.style.width = '0px';
                    flyingImg.style.height = '0px';
                    flyingImg.style.opacity = '0';
                }, 10);

                // 5. Kirim data ke server di belakang layar
                fetch(addToCartUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Setelah animasi selesai, refresh halaman untuk update keranjang
                    // Ini cara paling sederhana, nanti bisa di-update tanpa refresh
                    setTimeout(() => {
                        location.reload();
                    }, 800); // Tunggu 0.8 detik sebelum refresh
                });
                
                // Hapus gambar duplikat setelah animasi selesai
                setTimeout(() => {
                    flyingImg.remove();
                }, 1000); // 1 detik sesuai durasi transisi CSS
            });
        });
    }
});