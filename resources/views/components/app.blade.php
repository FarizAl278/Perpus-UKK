<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.11/dist/cdn.min.js"></script>
    <title>{{ $title ?? 'Perpustakaan' }}</title>
</head>

<body>

    {{-- Navbar --}}
    <x-navbar />

    {{-- Content --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />

</body>

<script>
    // AUTO HIDE TOAST
    setTimeout(() => {
        document.getElementById('toast-success')?.remove();
        document.getElementById('toast-error')?.remove();
    }, 3000);


    // OPEN MODAL (FIX DINAMIS 🔥)
    function openModal(id, judul, penulis, kategori, cover) {
        const modal = document.getElementById('modal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // SET DATA BUKU
        document.getElementById('modal_judul').innerText = judul;
        document.getElementById('modal_penulis').innerText = penulis;
        document.getElementById('modal_kategori').innerText = kategori;
        document.getElementById('modal_cover').src = cover;

        // SET FORM ACTION
        document.getElementById('modal_form').action = '/pinjam/' + id;

        updateTanggal();
    }


    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


    function updateTanggal() {
        const lama = parseInt(document.getElementById('lama_hari').value);
        const sekarang = new Date();
        sekarang.setDate(sekarang.getDate() + lama);

        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        document.getElementById('tanggal_kembali').textContent =
            sekarang.toLocaleDateString('id-ID', options);
    }

    function openModal(id, judul, penulis, kategori, cover) {
            document.getElementById('modal').classList.remove('hidden');

            document.getElementById('modal_judul').innerText = judul;
            document.getElementById('modal_penulis').innerText = penulis;
            document.getElementById('modal_kategori').innerText = kategori;
            document.getElementById('modal_cover').src = cover;

            document.getElementById('modal_form').action = '/pinjam/' + id;

            updateTanggal();
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function updateTanggal() {
            let hari = document.getElementById('lama_hari').value;
            let today = new Date();
            today.setDate(today.getDate() + parseInt(hari));

            document.getElementById('tanggal_kembali').innerText =
                today.toLocaleDateString('id-ID');
        }


    // CLOSE MODAL KLIK LUAR
    document.getElementById('modal')?.addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });


    // DROPDOWN
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown');

        if (dropdownButton && dropdownMenu) {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        }
    });
</script>

</html>
