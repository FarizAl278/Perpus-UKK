<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.11/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap');
    </style>
    <title>{{ $title ?? 'Libris' }}</title>
</head>
  {{ $slot }}
<script>
    // TOAST AUTO HIDE
    setTimeout(() => {
        document.getElementById('toast-success')?.remove();
        document.getElementById('toast-error')?.remove();
    }, 3000);

    // MODAL
    function openModal(id, judul, penulis, kategori, cover) {
        const modal = document.getElementById('modal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.getElementById('modal_judul').innerText = judul;
        document.getElementById('modal_penulis').innerText = penulis;
        document.getElementById('modal_kategori').innerText = kategori;
        document.getElementById('modal_cover').src = cover;

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

        document.getElementById('tanggal_kembali').textContent =
            sekarang.toLocaleDateString('id-ID');
    }

    // CLOSE MODAL CLICK OUTSIDE
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('modal');
        if (e.target === modal) closeModal();
    });

    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>

</html>