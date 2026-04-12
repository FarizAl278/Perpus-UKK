<style>
    footer, footer * { font-family: 'Sora', sans-serif; }
    .font-serif-display { font-family: 'DM Serif Display', serif; }
</style>

<footer class="relative z-10 mt-10">

    {{-- Top wave divider --}}
    <div class="overflow-hidden leading-none">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 block" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C360,0 1080,60 1440,20 L1440,60 L0,60 Z" fill="white" fill-opacity="0.7"/>
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
                    <div class="inline-flex items-center gap-2 bg-sky-50 border border-sky-100 rounded-xl px-4 py-2.5 text-xs text-sky-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse flex-shrink-0"></span>
                        Buka Senin – Sabtu, 07.00 – 16.00 WIB
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="text-xs font-semibold tracking-[0.18em] uppercase text-slate-400 mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li>
                            <a href="/" class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-house text-sky-300 text-xs"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="/riwayat" class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-clock-history text-sky-300 text-xs"></i> Riwayat Peminjaman
                            </a>
                        </li>
                        <li>
                            <a href="/profile" class="text-slate-500 hover:text-sky-600 transition-colors duration-200 flex items-center gap-2">
                                <i class="bi bi-person text-sky-300 text-xs"></i> Profil Saya
                            </a>
                        {{-- </li>
                        <li>
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
                        <li class="flex items-start gap-2">
                            <i class="bi bi-geo-alt text-sky-300 text-xs mt-0.5 flex-shrink-0"></i>
                            <span class="leading-relaxed">Jl. Perpustakaan No.1,<br>Kota, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="bi bi-envelope text-sky-300 text-xs flex-shrink-0"></i>
                            <a href="mailto:libris@sekolah.sch.id"
                               class="hover:text-sky-600 transition-colors duration-200">
                                libris@sekolah.sch.id
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