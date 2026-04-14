<x-app>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap');

        @keyframes slideInToast { from { opacity: 0; transform: translateX(20px) } to { opacity: 1; transform: translateX(0) } }
        @keyframes drift { from { transform: translateX(-350px) } to { transform: translateX(calc(100vw + 350px)) } }

        .cloud-1 { animation: drift 60s linear infinite; }
        .cloud-2 { animation: drift 80s linear -20s infinite; }
        .cloud-3 { animation: drift 100s linear -40s infinite; }
        .cloud-4 { animation: drift 70s linear -10s infinite; }
        .cloud-5 { animation: drift 90s linear -55s infinite; }

        body { font-family: 'Sora', sans-serif; }
        .font-serif-display { font-family: 'DM Serif Display', serif; }
        .toast-in { animation: slideInToast 0.3s ease; }
        [x-cloak] { display: none !important; }
    </style>

    {{-- ========== ANIMATED SKY BACKGROUND ========== --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <radialGradient id="skygrad2" cx="50%" cy="30%" r="70%">
                    <stop offset="0%" stop-color="#e0f7ff" /><stop offset="100%" stop-color="#f7fbff" />
                </radialGradient>
            </defs>
            <rect width="1440" height="900" fill="url(#skygrad2)" />
            <g class="cloud-1" style="opacity:0.55"><ellipse cx="180" cy="60" rx="110" ry="42" fill="white" /><ellipse cx="230" cy="45" rx="75" ry="38" fill="white" /><ellipse cx="130" cy="55" rx="65" ry="32" fill="white" /><ellipse cx="280" cy="60" rx="55" ry="28" fill="white" /></g>
            <g class="cloud-2" style="opacity:0.5;transform:translateY(150px)"><ellipse cx="200" cy="55" rx="130" ry="38" fill="white" /><ellipse cx="260" cy="38" rx="90" ry="35" fill="white" /><ellipse cx="150" cy="50" rx="70" ry="30" fill="white" /><ellipse cx="310" cy="55" rx="60" ry="26" fill="white" /></g>
            <g class="cloud-3" style="opacity:0.4;transform:translateY(320px)"><ellipse cx="160" cy="50" rx="95" ry="35" fill="#e8f5ff" /><ellipse cx="210" cy="38" rx="70" ry="32" fill="#e8f5ff" /><ellipse cx="115" cy="48" rx="60" ry="26" fill="#e8f5ff" /><ellipse cx="250" cy="52" rx="48" ry="22" fill="#e8f5ff" /></g>
            <g class="cloud-4" style="opacity:0.45;transform:translateY(490px)"><ellipse cx="100" cy="36" rx="72" ry="26" fill="white" /><ellipse cx="135" cy="25" rx="50" ry="24" fill="white" /><ellipse cx="70" cy="33" rx="44" ry="20" fill="white" /></g>
            <g class="cloud-5" style="opacity:0.38;transform:translateY(660px)"><ellipse cx="180" cy="44" rx="115" ry="32" fill="#f0f9ff" /><ellipse cx="230" cy="32" rx="78" ry="30" fill="#f0f9ff" /><ellipse cx="135" cy="42" rx="62" ry="24" fill="#f0f9ff" /><ellipse cx="275" cy="44" rx="52" ry="22" fill="#f0f9ff" /></g>
        </svg>
    </div>

    {{-- ========== TOAST ========== --}}
    @if (session('success'))
        <div id="toast-success" class="toast-in fixed top-5 right-5 z-[60] flex items-center gap-2 bg-emerald-50 text-emerald-800 border border-emerald-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium">
            <i class="bi bi-check-circle-fill text-emerald-500"></i><span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div id="toast-error" class="toast-in fixed top-5 right-5 z-[60] flex items-center gap-2 bg-rose-50 text-rose-800 border border-rose-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium">
            <i class="bi bi-x-circle-fill text-rose-500"></i><span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ========== MAIN WRAPPER (X-DATA MENCANGKUP SEMUA) ========== --}}
    <div x-data="riwayatPage()" class="relative z-10 max-w-6xl mx-auto px-6 pt-36 pb-24">

        {{-- Page header --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-3"><span class="block w-6 h-px bg-sky-400"></span><p class="text-[0.68rem] font-semibold tracking-[0.22em] uppercase text-sky-500">Akun Saya</p></div>
            <h1 class="font-serif-display text-4xl text-slate-900">Riwayat Peminjaman</h1>
        </div>

        @if ($riwayat->isEmpty())
            <div class="text-center py-24 bg-white/70 backdrop-blur-md border border-sky-100 rounded-3xl shadow-[0_4px_24px_rgba(14,165,233,0.06)]">
                <div class="w-16 h-16 bg-sky-50 border border-sky-100 rounded-2xl flex items-center justify-center mx-auto mb-5"><i class="bi bi-book text-2xl text-sky-400"></i></div>
                <p class="text-slate-600 font-medium mb-1">Belum ada riwayat peminjaman</p>
                <p class="text-sm text-slate-400 mb-6">Kamu belum pernah meminjam buku.</p>
                <a href="/" class="inline-flex items-center gap-2 px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-full transition-all duration-200 hover:-translate-y-0.5"><i class="bi bi-grid-3x3-gap"></i> Lihat Katalog</a>
            </div>
        @else
            @php
                $total = $riwayat->count();
                $pengambilan = $riwayat->where('status', 'pengambilan')->count();
                $dibatalkan = $riwayat->where('status', 'dibatalkan')->count();
                $aktif = $riwayat->where('status', 'dipinjam')->count();
                $terlambat = $riwayat->filter(fn($i) => $i->status === 'terlambat' || ($i->status === 'dipinjam' && \Carbon\Carbon::parse($i->tanggal_kembali)->isPast()))->count();
            @endphp

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-6">
                <div class="bg-white/70 backdrop-blur-md border border-sky-100 rounded-2xl px-5 py-4 shadow-[0_4px_16px_rgba(14,165,233,0.06)]"><p class="text-xs text-slate-400 font-medium mb-1">Total Pinjam</p><p class="font-serif-display text-3xl text-slate-900">{{ $total }}</p></div>
                <div class="bg-white/70 backdrop-blur-md border border-amber-100 rounded-2xl px-5 py-4 shadow-[0_4px_16px_rgba(251,191,36,0.06)]"><p class="text-xs text-slate-400 font-medium mb-1">Menunggu Diambil</p><p class="font-serif-display text-3xl text-amber-500">{{ $pengambilan }}</p></div>
                <div class="bg-white/70 backdrop-blur-md border border-sky-100 rounded-2xl px-5 py-4 shadow-[0_4px_16px_rgba(14,165,233,0.06)]"><p class="text-xs text-slate-400 font-medium mb-1">Sedang Dipinjam</p><p class="font-serif-display text-3xl text-sky-500">{{ $aktif }}</p></div>
                <div class="bg-white/70 backdrop-blur-md border {{ $terlambat > 0 ? 'border-rose-100' : 'border-sky-100' }} rounded-2xl px-5 py-4 shadow-[0_4px_16px_rgba(14,165,233,0.06)]"><p class="text-xs text-slate-400 font-medium mb-1">Terlambat</p><p class="font-serif-display text-3xl {{ $terlambat > 0 ? 'text-rose-500' : 'text-slate-900' }}">{{ $terlambat }}</p></div>
                <div class="bg-white/70 backdrop-blur-md border {{ $dibatalkan > 0 ? 'border-slate-400' : 'border-sky-100' }} rounded-2xl px-5 py-4 shadow-[0_4px_16px_rgba(14,165,233,0.06)]"><p class="text-xs text-slate-400 font-medium mb-1">Dibatalkan</p><p class="font-serif-display text-3xl {{ $dibatalkan > 0 ? 'text-slate-500' : 'text-slate-900' }}">{{ $dibatalkan }}</p></div>
            </div>

            {{-- Search & Filter --}}
            <div class="flex flex-col sm:flex-row gap-3 mb-5">
                <div class="flex items-center flex-1 bg-white/70 backdrop-blur-md border border-sky-100 rounded-xl px-4 gap-2.5 shadow-[0_2px_12px_rgba(14,165,233,0.05)] focus-within:border-sky-400 transition-colors duration-200">
                    <i class="bi bi-search text-slate-400 text-sm flex-shrink-0"></i>
                    <input type="text" x-model="search" placeholder="Cari judul atau penulis…" class="flex-1 py-3 text-sm text-slate-700 bg-transparent outline-none placeholder:text-slate-400">
                    <button x-show="search" x-cloak @click="search=''" class="text-slate-300 hover:text-slate-500 transition-colors"><i class="bi bi-x-lg text-xs"></i></button>
                </div>
                <div class="flex gap-2 flex-shrink-0 flex-wrap">
                    <button @click="filter='semua'" :class="filter === 'semua' ? 'bg-sky-500 text-white border-sky-500' : 'bg-white/70 text-slate-500 border-sky-100 hover:border-sky-400'" class="px-4 py-2 rounded-xl text-xs font-semibold border-[1.5px] transition-all duration-200 backdrop-blur-md">Semua</button>
                    <button @click="filter='pengambilan'" :class="filter === 'pengambilan' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white/70 text-slate-500 border-sky-100 hover:border-amber-400'" class="px-4 py-2 rounded-xl text-xs font-semibold border-[1.5px] transition-all duration-200 backdrop-blur-md">Pengambilan</button>
                    <button @click="filter='dipinjam'" :class="filter === 'dipinjam' ? 'bg-sky-500 text-white border-sky-500' : 'bg-white/70 text-slate-500 border-sky-100 hover:border-sky-400'" class="px-4 py-2 rounded-xl text-xs font-semibold border-[1.5px] transition-all duration-200 backdrop-blur-md">Dipinjam</button>
                    <button @click="filter='kembali'" :class="filter === 'kembali' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white/70 text-slate-500 border-sky-100 hover:border-emerald-400'" class="px-4 py-2 rounded-xl text-xs font-semibold border-[1.5px] transition-all duration-200 backdrop-blur-md">Dikembalikan</button>
                    <button @click="filter='terlambat'" :class="filter === 'terlambat' ? 'bg-rose-500 text-white border-rose-500' : 'bg-white/70 text-slate-500 border-sky-100 hover:border-rose-400'" class="px-4 py-2 rounded-xl text-xs font-semibold border-[1.5px] transition-all duration-200 backdrop-blur-md">Terlambat</button>
                    <button @click="filter='dibatalkan'" :class="filter === 'dibatalkan' ? 'bg-slate-500 text-white border-slate-500' : 'bg-white/70 text-slate-500 border-sky-100 hover:border-slate-400'" class="px-4 py-2 rounded-xl text-xs font-semibold border-[1.5px] transition-all duration-200 backdrop-blur-md">Dibatalkan</button>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white/70 backdrop-blur-md border border-sky-100 rounded-3xl shadow-[0_4px_24px_rgba(14,165,233,0.06)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-sky-100">
                                <th class="px-5 py-4 text-left text-[0.68rem] font-semibold tracking-[0.16em] uppercase text-slate-400">#</th>
                                <th class="px-5 py-4 text-left text-[0.68rem] font-semibold tracking-[0.16em] uppercase text-slate-400">Buku</th>
                                <th class="px-5 py-4 text-left text-[0.68rem] font-semibold tracking-[0.16em] uppercase text-slate-400">Tanggal</th>
                                <th class="px-5 py-4 text-left text-[0.68rem] font-semibold tracking-[0.16em] uppercase text-slate-400">Status</th>
                                <th class="px-5 py-4 text-left text-[0.68rem] font-semibold tracking-[0.16em] uppercase text-slate-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sky-50" id="riwayat-tbody">
                            @foreach ($riwayat as $index => $item)
                                @php
                                    $kembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                                    $isLate = $item->status === 'terlambat' || ($item->status === 'dipinjam' && $kembali->isPast());
                                    $isPengambilan = $item->status === 'pengambilan';
                                    $isDibatalkan = $item->status === 'dibatalkan';
                                    $deadlinePengambilan = $isPengambilan && $item->expired_at ? \Carbon\Carbon::parse($item->expired_at)->timestamp : 0;

                                    $rowBg = match (true) {
                                        $isLate => 'bg-rose-50/70 hover:bg-rose-50',
                                        $isPengambilan => 'bg-amber-50/50 hover:bg-amber-50/80',
                                        $isDibatalkan => 'bg-slate-50/50 hover:bg-slate-50',
                                        default => 'hover:bg-sky-50/50',
                                    };
                                    $badge = match (true) {
                                        $isLate => 'bg-rose-100 text-rose-600 border-rose-200',
                                        $isPengambilan => 'bg-amber-50 text-amber-600 border-amber-200',
                                        $item->status === 'dipinjam' => 'bg-sky-50 text-sky-600 border-sky-100',
                                        $item->status === 'kembali' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                        $item->status === 'dibatalkan' => 'bg-slate-100 text-slate-500 border-slate-200',
                                        default => 'bg-slate-100 text-slate-500 border-slate-200',
                                    };
                                    $icon = match (true) {
                                        $isLate => 'bi-exclamation-circle-fill',
                                        $isPengambilan => 'bi-hourglass-split',
                                        $item->status === 'dipinjam' => 'bi-bookmark-fill',
                                        $item->status === 'kembali' => 'bi-check-circle-fill',
                                        $item->status === 'dibatalkan' => 'bi-x-circle-fill',
                                        default => 'bi-dash-circle',
                                    };
                                    $label = match (true) {
                                        $isLate => 'Terlambat',
                                        $isPengambilan => 'Menunggu Diambil',
                                        $item->status === 'kembali' => 'Dikembalikan',
                                        $item->status === 'dibatalkan' => 'Dibatalkan',
                                        default => ucfirst($item->status),
                                    };
                                    $textColor = match (true) {
                                        $isLate => 'text-rose-700',
                                        $isPengambilan => 'text-amber-700',
                                        $isDibatalkan => 'text-slate-600',
                                        default => 'text-slate-800',
                                    };
                                    $subColor = match (true) {
                                        $isLate => 'text-rose-400',
                                        $isPengambilan => 'text-amber-400',
                                        $isDibatalkan => 'text-slate-400',
                                        default => 'text-slate-400',
                                    };
                                    $dateColor = match (true) {
                                        $isLate => 'text-rose-500',
                                        $isPengambilan => 'text-amber-500',
                                        $isDibatalkan => 'text-slate-500',
                                        default => 'text-slate-500',
                                    };
                                @endphp

                                <tr id="row-{{ $item->id }}" x-show="isVisible({{ Js::from($item->book->judul) }}, {{ Js::from($item->book->penulis) }}, {{ Js::from($item->status) }}, {{ $isLate ? 'true' : 'false' }})" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="group transition-colors duration-150 {{ $rowBg }}">

                                    <td class="px-5 py-4 text-xs {{ $subColor }}">{{ $index + 1 }}</td>

                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('storage/' . $item->book->cover) }}" class="w-10 h-14 object-cover rounded-lg shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                                            <div><p class="font-semibold leading-snug {{ $textColor }}">{{ $item->book->judul }}</p><p class="text-xs mt-0.5 {{ $subColor }}">{{ $item->book->penulis }}</p></div>
                                        </div>
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="text-xs font-medium {{ $dateColor }}">{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}</p>
                                        <p class="text-xs {{ $subColor }} mt-0.5">→ {{ $kembali->format('d M Y') }}</p>
                                        @if ($isLate && $item->status === 'dipinjam')<p class="text-[0.65rem] text-rose-400 mt-0.5">{{ $kembali->diffForHumans() }}</p>@endif
                                        @if ($isPengambilan)
                                            <div x-data="countdown({{ $deadlinePengambilan }}, {{ $item->id }})" x-init="start()" class="mt-1.5">
                                                <div x-show="!expired" class="inline-flex items-center gap-1.5 bg-amber-100 border border-amber-200 text-amber-700 text-[0.65rem] font-semibold px-2 py-0.5 rounded-lg"><i class="bi bi-alarm text-[0.6rem]"></i><span x-text="display"></span></div>
                                                <div x-show="expired" x-cloak class="inline-flex items-center gap-1 text-rose-400 text-[0.65rem] font-semibold"><i class="bi bi-x-circle text-[0.6rem]"></i> Waktu habis</div>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.7rem] font-semibold border {{ $badge }}"><i class="bi {{ $icon }} text-[0.6rem]"></i>{{ $label }}</span>
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex gap-2">
                                            <button @click="openDetail({{ Js::from(['judul' => $item->book->judul, 'penulis' => $item->book->penulis, 'genre' => $item->book->genre, 'cover' => asset('storage/' . $item->book->cover), 'kelas' => $item->kelas, 'jurusan' => $item->jurusan, 'tanggal_peminjaman' => \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y'), 'tanggal_kembali' => $kembali->format('d M Y'), 'status' => $item->status, 'is_late' => $isLate, 'is_pengambilan' => $isPengambilan, 'is_dibatalkan' => $isDibatalkan, 'label' => $label, 'deadline_ts' => $deadlinePengambilan, 'id' => $item->id]) }})" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-medium border-[1.5px] transition-all duration-200 {{ $isLate ? 'text-rose-500 border-rose-200 hover:bg-rose-50' : ($isPengambilan ? 'text-amber-500 border-amber-200 hover:bg-amber-50' : ($isDibatalkan ? 'text-slate-500 border-slate-200 hover:bg-slate-50' : 'text-sky-600 border-sky-200 hover:bg-sky-50')) }}"><i class="bi bi-eye text-xs"></i> Detail</button>
                                            @if ($isPengambilan)
                                                <button type="button" @click="openCancelModal({{ $item->id }}, '{{ addslashes($item->book->judul) }}')" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-medium border-[1.5px] border-rose-200 text-rose-600 hover:bg-rose-50 transition-all duration-200"><i class="bi bi-x-circle text-xs"></i> Batal</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-3.5 border-t border-sky-50 bg-sky-50/30 flex items-center justify-between"><p class="text-xs text-slate-400">Menampilkan <span class="font-medium text-slate-600">{{ $riwayat->count() }}</span> data peminjaman</p><p x-show="search || filter !== 'semua'" x-cloak class="text-xs text-sky-500 font-medium">Filter aktif</p></div>
            </div>
            <div x-show="noResults" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="text-center py-12 text-slate-400 text-sm mt-2"><i class="bi bi-search text-2xl block mb-2 text-slate-300"></i>Tidak ada hasil yang cocok.</div>
        @endif

        {{-- ========== DETAIL MODAL ========== --}}
        <div x-data x-show="$store.modal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="$store.modal.open = false" @keydown.escape.window="$store.modal.open = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" style="display:none;">
            <div x-show="$store.modal.open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-3" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="bg-white w-full max-w-md rounded-3xl shadow-[0_32px_80px_rgba(12,35,64,0.18)] overflow-hidden">
                <div class="flex items-center justify-between px-7 pt-6 pb-4"><h2 class="font-serif-display text-2xl text-slate-900">Detail Peminjaman</h2><button @click="$store.modal.open = false" class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all duration-200"><i class="bi bi-x-lg text-sm"></i></button></div>
                <div x-show="$store.modal.data.is_pengambilan" x-cloak class="mx-7 mb-3">
                    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-xs text-amber-700">
                        <div class="flex items-start gap-2.5 mb-2"><i class="bi bi-hourglass-split mt-0.5 flex-shrink-0"></i><div><p class="font-semibold mb-0.5">Menunggu Pengambilan</p><p class="text-amber-600 font-normal">Segera ambil buku ke perpustakaan. Jika tidak, peminjaman akan otomatis dibatalkan.</p></div></div>
                        <div x-data="{ deadline: 0, display: '', expired: false, interval: null, init() { this.$nextTick(() => { const data = Alpine.store('modal')?.data; this.deadline = data?.deadline_ts ? parseInt(data.deadline_ts) : 0; if (this.deadline > 0) { this.update(); this.interval = setInterval(() => this.update(), 1000); } else { this.expired = true; } }); }, update() { const now = Math.floor(Date.now() / 1000); const diff = this.deadline - now; if (diff <= 0) { this.expired = true; this.display = '00:00:00'; if (this.interval) clearInterval(this.interval); return; } const h = Math.floor(diff / 3600); const m = Math.floor((diff % 3600) / 60); const s = diff % 60; this.display = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`; }, destroy() { if (this.interval) clearInterval(this.interval); } }" x-init="init()" @keydown.escape.window="destroy()" class="mt-2 pt-2 border-t border-amber-200">
                            <template x-if="!expired"><div class="flex items-center justify-between"><span class="text-amber-500 font-medium">Sisa waktu</span><span class="font-bold text-amber-700 tabular-nums text-sm" x-text="display"></span></div></template>
                        </div>
                    </div>
                </div>
                <div x-show="$store.modal.data.is_late" x-cloak class="mx-7 mb-3 flex items-center gap-2.5 bg-rose-50 border border-rose-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-rose-600"><i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>Peminjaman ini melewati batas waktu pengembalian!</div>
                <div class="px-7 pb-6 space-y-4">
                    <div class="flex gap-4 items-start border rounded-2xl p-4" :class="{ 'bg-rose-50 border-rose-100': $store.modal.data.is_late, 'bg-amber-50 border-amber-100': $store.modal.data.is_pengambilan && !$store.modal.data.is_late, 'bg-sky-50 border-sky-100': !$store.modal.data.is_late && !$store.modal.data.is_pengambilan, }">
                        <img :src="$store.modal.data.cover" class="w-16 h-24 object-cover rounded-xl shadow-sm flex-shrink-0">
                        <div class="pt-1"><span class="inline-block text-[0.65rem] font-semibold tracking-wide uppercase px-2.5 py-0.5 rounded-full mb-2 border" :class="{ 'bg-rose-100 text-rose-500 border-rose-200': $store.modal.data.is_late, 'bg-amber-100 text-amber-600 border-amber-200': $store.modal.data.is_pengambilan && !$store.modal.data.is_late, 'bg-white text-sky-600 border-sky-200': !$store.modal.data.is_late && !$store.modal.data.is_pengambilan, }" x-text="$store.modal.data.genre"></span><h3 class="font-semibold text-slate-900 leading-snug mb-1 text-sm" x-text="$store.modal.data.judul"></h3><p class="text-xs text-slate-400" x-text="$store.modal.data.penulis"></p></div>
                    </div>
                    <div class="divide-y divide-slate-100 rounded-2xl border border-slate-100 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 bg-white"><span class="text-xs text-slate-400 font-medium">Kelas</span><span class="text-xs font-semibold text-slate-700" x-text="$store.modal.data.kelas"></span></div>
                        <div class="flex items-center justify-between px-4 py-3 bg-white"><span class="text-xs text-slate-400 font-medium">Jurusan</span><span class="text-xs font-semibold text-slate-700" x-text="$store.modal.data.jurusan"></span></div>
                        <div class="flex items-center justify-between px-4 py-3 bg-white"><span class="text-xs text-slate-400 font-medium">Tanggal Pinjam</span><span class="text-xs font-semibold text-slate-700" x-text="$store.modal.data.tanggal_peminjaman"></span></div>
                        <div class="flex items-center justify-between px-4 py-3 bg-white"><span class="text-xs text-slate-400 font-medium">Tanggal Kembali</span><span class="text-xs font-semibold" :class="$store.modal.data.is_late ? 'text-rose-500' : 'text-slate-700'" x-text="$store.modal.data.tanggal_kembali"></span></div>
                        <div class="flex items-center justify-between px-4 py-3 bg-white"><span class="text-xs text-slate-400 font-medium">Status</span><span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.7rem] font-semibold border" :class="{ 'bg-rose-100 text-rose-600 border-rose-200': $store.modal.data.is_late, 'bg-amber-50 text-amber-600 border-amber-200': $store.modal.data.is_pengambilan && !$store.modal.data.is_late, 'bg-sky-50 text-sky-600 border-sky-100': !$store.modal.data.is_late && !$store.modal.data.is_pengambilan && $store.modal.data.status === 'dipinjam', 'bg-emerald-50 text-emerald-600 border-emerald-100': $store.modal.data.status === 'kembali', 'bg-slate-100 text-slate-500 border-slate-200': !$store.modal.data.is_late && !$store.modal.data.is_pengambilan && $store.modal.data.status !== 'dipinjam' && $store.modal.data.status !== 'kembali', }"><i class="bi text-[0.6rem]" :class="{ 'bi-exclamation-circle-fill': $store.modal.data.is_late, 'bi-hourglass-split': $store.modal.data.is_pengambilan && !$store.modal.data.is_late, 'bi-bookmark-fill': !$store.modal.data.is_late && !$store.modal.data.is_pengambilan && $store.modal.data.status === 'dipinjam', 'bi-check-circle-fill': $store.modal.data.status === 'kembali', 'bi-dash-circle': !$store.modal.data.is_late && !$store.modal.data.is_pengambilan && $store.modal.data.status !== 'dipinjam' && $store.modal.data.status !== 'kembali', }"></i><span x-text="$store.modal.data.label"></span></span></div>
                    </div>
                    @if ($isPengambilan)
                        <div class="pt-2"><button @click="$store.modal.open = false; openCancelModal($store.modal.data.id, $store.modal.data.judul)" class="w-full py-2.5 rounded-full bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold transition-all duration-200 shadow-md shadow-rose-200/50 flex items-center justify-center gap-2"><i class="bi bi-x-circle"></i> Batalkan Peminjaman</button></div>
                    @else
                        <div class="px-7 pb-7"><button @click="$store.modal.open = false" class="w-full py-2.5 rounded-full border-[1.5px] border-sky-200 text-sky-600 hover:bg-sky-50 text-sm font-semibold transition-all duration-200">Tutup</button></div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ========== CANCEL CONFIRMATION MODAL (INSIDE riwayatPage SCOPE) ========== --}}
        <template x-if="showCancelModal">
            <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="showCancelModal = false" @keydown.escape.window="showCancelModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[60] flex items-center justify-center p-4" x-cloak>
                <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-3" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="bg-white w-full max-w-md rounded-3xl shadow-[0_32px_80px_rgba(12,35,64,0.18)] overflow-hidden">
                    <div class="px-7 pt-8 pb-4 text-center">
                        <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4"><i class="bi bi-exclamation-triangle text-3xl text-rose-500"></i></div>
                        <h2 class="font-serif-display text-2xl text-slate-900 mb-2">Batalkan Peminjaman?</h2>
                        <p class="text-slate-500 text-sm mb-1">Kamu akan membatalkan peminjaman buku:</p>
                        <p class="font-semibold text-slate-900 text-base mb-4" x-text="cancelBookTitle"></p>
                        <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-xs text-amber-700 text-left"><p class="font-semibold mb-1"><i class="bi bi-info-circle mr-1"></i> Perhatian:</p><ul class="list-disc list-inside space-y-1 ml-1"><li>Pembatalan tidak dapat diurungkan</li><li>Stok buku akan dikembalikan</li><li>Kamu perlu meminjam ulang jika berubah pikiran</li></ul></div>
                    </div>
                    <div class="px-7 pb-7 flex gap-3">
                        <button type="button" @click="showCancelModal = false" class="flex-1 px-5 py-2.5 rounded-full border-[1.5px] border-slate-300 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition-all duration-200">Tidak, Kembali</button>
                        <form :action="cancelFormAction" method="POST" class="flex-1">@csrf @method('POST')<button type="submit" class="w-full px-5 py-2.5 rounded-full bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold transition-all duration-200 shadow-md shadow-rose-200/50">Ya, Batalkan</button></form>
                    </div>
                </div>
            </div>
        </template>

    </div> {{-- END x-data="riwayatPage()" --}}

    <script>
        // Toast auto-hide
        setTimeout(() => { document.getElementById('toast-success')?.remove(); document.getElementById('toast-error')?.remove(); }, 3000);

        // Init Alpine store for detail modal
        document.addEventListener('alpine:init', () => { Alpine.store('modal', { open: false, data: {} }); });

        // 🔥 COUNTDOWN COMPONENT
        function countdown(deadlineTimestamp, rowId = null) {
            return {
                display: '', expired: false, urgent: false, interval: null,
                start() { if (!deadlineTimestamp || deadlineTimestamp <= 0) { this.expired = true; return; } this.update(); this.interval = setInterval(() => this.update(), 1000); },
                update() {
                    const now = Math.floor(Date.now() / 1000); const diff = deadlineTimestamp - now;
                    if (diff <= 0) { this.expired = true; this.display = '00:00:00'; if (this.interval) clearInterval(this.interval); return; }
                    const h = Math.floor(diff / 3600); const m = Math.floor((diff % 3600) / 60); const s = diff % 60;
                    this.display = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`; this.urgent = diff < 1800;
                },
                destroy() { if (this.interval) clearInterval(this.interval); }
            };
        }

        // 🔥 MAIN PAGE LOGIC (SEMUA DALAM 1 SCOPE)
        function riwayatPage() {
            return {
                search: '', filter: 'semua', noResults: false,
                // ✅ Cancel Modal State
                showCancelModal: false, cancelBookTitle: '', cancelFormAction: '',

                isVisible(judul, penulis, status, isLate) {
                    const q = this.search.toLowerCase().trim();
                    const matchSearch = q === '' || judul.toLowerCase().includes(q) || penulis.toLowerCase().includes(q);
                    let matchFilter = false;
                    switch (this.filter) {
                        case 'semua': matchFilter = true; break;
                        case 'terlambat': matchFilter = isLate; break;
                        case 'dipinjam': matchFilter = status === 'dipinjam' && !isLate; break;
                        case 'pengambilan': matchFilter = status === 'pengambilan'; break;
                        case 'dibatalkan': matchFilter = status === 'dibatalkan'; break;
                        default: matchFilter = status === this.filter;
                    }
                    return matchSearch && matchFilter;
                },

                openDetail(data) {
                    document.querySelectorAll('[x-data*="deadline"]').forEach(el => { if (el.__x?.data?.destroy) el.__x.data.destroy(); });
                    Alpine.store('modal').data = data; Alpine.store('modal').open = true; document.body.style.overflow = 'hidden';
                },

                // ✅ METHOD CANCEL (Inside same scope)
                openCancelModal(id, title) {
                    console.log('🔄 Cancel clicked:', id, title); // Debug log
                    this.cancelBookTitle = title;
                    this.cancelFormAction = `/riwayat/${id}/cancel`;
                    this.showCancelModal = true;
                    console.log('✅ Modal state:', this.showCancelModal); // Debug log
                },

                init() { this.$watch('search', () => this.checkNoResults()); this.$watch('filter', () => this.checkNoResults()); this.checkNoResults(); },
                checkNoResults() { this.$nextTick(() => { const rows = document.querySelectorAll('#riwayat-tbody tr'); this.noResults = rows.length > 0 && Array.from(rows).every(row => row.style.display === 'none'); }); }
            };
        }
    </script>
</x-app>