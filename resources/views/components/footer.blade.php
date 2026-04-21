<style>
    footer,
    footer * {
        font-family: 'Sora', sans-serif;
    }

    .font-serif-display {
        font-family: 'DM Serif Display', serif;
    }
</style>

<footer class="relative z-10 mt-10">

    {{-- Top wave divider --}}
    <div class="overflow-hidden leading-none">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 block" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C360,0 1080,60 1440,20 L1440,60 L0,60 Z" fill="white" fill-opacity="0.7" />
        </svg>
    </div>

    <div class="bg-white/70 backdrop-blur-md ">

        {{-- Main footer content --}}
        <div class="max-w-6xl mx-auto px-6 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2.5 mb-4">
                        <img src="{{ asset('logo-naked-libris.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        <span class="font-serif-display text-2xl text-slate-900">
                            Libr<em class="text-sky-500 italic">is</em>
                        </span>
                    </div>

                    <p class="text-sm text-slate-500 leading-relaxed max-w-xs mb-5">
                        Perpustakaan digital modern yang hadir untuk memudahkan akses meminjam buku.
                        Temukan, pinjam, dan kembalikan buku kapan saja.
                    </p>

                    {{-- Jam operasional --}}
                    <div
                        class="inline-flex items-center gap-2 bg-sky-50 border border-sky-100 rounded-xl px-4 py-2.5 text-xs text-sky-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse flex-shrink-0"></span>
                        Buka Senin – Sabtu, 07.30 – 16.00 WIB
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-400 mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="/"
                                class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-house text-sky-300 text-xs"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="/riwayat"
                                class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-clock-history text-sky-300 text-xs"></i> Riwayat Peminjaman
                            </a>
                        </li>
                        <li>
                            <a href="/profile"
                                class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-person text-sky-300 text-xs"></i> Profil Saya
                            </a>
                        </li>
                        {{-- <li>
                            <a href="/admin/login" class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-shield-lock text-sky-300 text-xs"></i> Portal Admin
                            </a>
                        </li> --}}
                    </ul>
                </div>

                {{-- Informasi --}}
                <div>
                    <h4 class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-400 mb-4">Informasi</h4>
                    <ul class="space-y-3 text-sm text-slate-500">
                        {{-- Simple Maps Preview --}}
                        <p class="text-xs text-slate-400 mt-2"><i class="bi bi-geo-alt text-sky-300 text-xs mt-0.5 flex-shrink-0"></i>Jl. Letjen Ibrahim Adjie No.178, Bogor</p>
                        <div
                            class="relative rounded-xl overflow-hidden h-32 border border-sky-100 shadow-sm hover:shadow-md transition-shadow duration-200 group">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.6754255831944!2d106.81064!3d-6.5960!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c3cf4c18fa89%3A0x8b0a67e5b4f8d7a9!2sJl.%20Letjen%20Ibrahim%20Adjie%20No.178!5e0!3m2!1sid!2sid!4v1640000000000"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="grayscale group-hover:grayscale-0 transition-all duration-300">
                            </iframe>
                            <div
                                class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 text-[0.65rem] font-semibold text-sky-600 pointer-events-none">
                                <i class="bi bi-geo-alt"></i> Bogor
                            </div>
                        </div>
                        <li class="flex items-center gap-2">
                            <i class="bi bi-envelope text-sky-300 text-xs flex-shrink-0"></i>
                            <a href="mailto:libris@sekolah.sch.id"
                                class="hover:text-sky-600 transition-colors duration-200">
                                infokom-libris.sch.id
                            </a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="bi bi-telephone text-sky-300 text-xs flex-shrink-0"></i>
                            <span>(021) 000-0000</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-sky-100/80">
            <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2">

                <p class="text-xs text-slate-400">
                    © {{ date('Y') }} <span class="font-medium text-slate-500">Libris</span> — Perpustakaan Digital.
                    Seluruh hak cipta dilindungi.
                </p>

                <div class="flex items-center gap-1.5 text-xs text-slate-400">
                    <i class="bi bi-book text-sky-300"></i>
                    <span>Dibuat dengan semangat membaca</span>
                </div>

            </div>
        </div>

    </div>
</footer>
