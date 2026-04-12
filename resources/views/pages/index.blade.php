<x-app>

    {{-- ========== FONTS ========== --}}
    <style>
        .font-serif-display {
            font-family: 'DM Serif Display', serif;
        }

        .font-sora {
            font-family: 'Sora', sans-serif;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: #f7fbff;
        }

        @keyframes drift {
            from {
                transform: translateX(-350px);
            }

            to {
                transform: translateX(calc(100vw + 350px));
            }
        }

        .cloud-1 {
            animation: drift 60s linear infinite;
        }

        .cloud-2 {
            animation: drift 80s linear -20s infinite;
        }

        .cloud-3 {
            animation: drift 100s linear -40s infinite;
        }

        .cloud-4 {
            animation: drift 70s linear -10s infinite;
        }

        .cloud-5 {
            animation: drift 90s linear -55s infinite;
        }

        @keyframes bob {

            0%,
            100% {
                transform: translateX(-50%) translateY(0)
            }

            50% {
                transform: translateX(-50%) translateY(6px)
            }
        }

        .bob {
            animation: bob 2s ease-in-out infinite;
        }

        @keyframes slideInToast {
            from {
                opacity: 0;
                transform: translateX(20px)
            }

            to {
                opacity: 1;
                transform: translateX(0)
            }
        }

        .toast-in {
            animation: slideInToast 0.3s ease;
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(12px)
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0)
            }
        }

        .modal-pop {
            animation: modalPop 0.25s ease;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    {{-- ========== TOAST ========== --}}
    @if (session('success'))
        <div id="toast-success"
            class="toast-in fixed top-5 right-5 z-50 flex items-center gap-2 bg-emerald-50 text-emerald-800 border border-emerald-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div id="toast-error"
            class="toast-in fixed top-5 right-5 z-50 flex items-center gap-2 bg-rose-50 text-rose-800 border border-rose-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium">
            <i class="bi bi-x-circle-fill text-rose-400"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ========== ANIMATED SKY BACKGROUND ========== --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" class="w-full h-full"
            xmlns="http://www.w3.org/2000/svg">

            <defs>
                <radialGradient id="skygrad" cx="50%" cy="30%" r="70%">
                    <stop offset="0%" stop-color="#d6f0ff" />
                    <stop offset="100%" stop-color="#f7fbff" />
                </radialGradient>
            </defs>

            <rect width="1440" height="900" fill="url(#skygrad)" />

            <!-- CLOUD 1 -->
            <g class="cloud-1" style="opacity:0.9; transform:translateY(250px)">
                <ellipse cx="180" cy="140" rx="120" ry="45" fill="white" />
                <ellipse cx="240" cy="120" rx="85" ry="40" fill="white" />
                <ellipse cx="130" cy="135" rx="70" ry="35" fill="white" />
                <ellipse cx="300" cy="140" rx="60" ry="30" fill="white" />
            </g>

            <!-- CLOUD 2 -->
            <g class="cloud-2" style="opacity:0.85; transform:translateY(380px)">
                <ellipse cx="200" cy="130" rx="140" ry="40" fill="white" />
                <ellipse cx="270" cy="110" rx="95" ry="38" fill="white" />
                <ellipse cx="150" cy="125" rx="75" ry="32" fill="white" />
                <ellipse cx="320" cy="130" rx="65" ry="28" fill="white" />
            </g>

            <!-- CLOUD 3 -->
            <g class="cloud-3" style="opacity:0.75; transform:translateY(520px)">
                <ellipse cx="160" cy="120" rx="110" ry="38" fill="#eef9ff" />
                <ellipse cx="220" cy="100" rx="80" ry="35" fill="#eef9ff" />
                <ellipse cx="120" cy="115" rx="65" ry="28" fill="#eef9ff" />
                <ellipse cx="270" cy="120" rx="55" ry="25" fill="#eef9ff" />
            </g>

            <!-- CLOUD 4 -->
            <g class="cloud-4" style="opacity:0.8; transform:translateY(650px)">
                <ellipse cx="120" cy="100" rx="80" ry="28" fill="white" />
                <ellipse cx="160" cy="85" rx="55" ry="26" fill="white" />
                <ellipse cx="80" cy="95" rx="48" ry="22" fill="white" />
            </g>

            <!-- CLOUD 5 -->
            <g class="cloud-5" style="opacity:0.7; transform:translateY(780px)">
                <ellipse cx="200" cy="110" rx="120" ry="35" fill="#f0f9ff" />
                <ellipse cx="260" cy="95" rx="85" ry="32" fill="#f0f9ff" />
                <ellipse cx="150" cy="105" rx="70" ry="26" fill="#f0f9ff" />
                <ellipse cx="300" cy="110" rx="60" ry="24" fill="#f0f9ff" />
            </g>

        </svg>
    </div>

    {{-- ========== CONTENT ========== --}}
    <div class="relative z-10">

        {{-- ===== HERO ===== --}}
        <section class="relative min-h-[90vh] flex flex-col items-center justify-center text-center px-6 pt-28 pb-20">

            <div class="flex items-center gap-3 mb-6">
                <span class="block w-7 h-px bg-sky-400"></span>
                <p class="text-[0.68rem] font-semibold tracking-[0.22em] uppercase text-sky-500">Perpustakaan Libris
                </p>
                <span class="block w-7 h-px bg-sky-400"></span>
            </div>

            <h1 class="font-serif-display text-[clamp(3.2rem,8vw,6rem)] leading-[1.05] text-slate-900 mb-5">
                Buku yang tepat,<br>
                selalu di <em class="text-sky-500 not-italic">tangan</em>mu
            </h1>

            <p class="text-slate-500 font-light text-lg max-w-md leading-relaxed mb-8">
                Temukan, pinjam, dan jelajahi berbagai koleksi buku.
                Perpustakaan digital modern untuk pengalaman membaca yang lebih praktis.
            </p>

            {{-- Search --}}
            <form method="GET" action="/" class="w-full max-w-xl">
                <div
                    class="flex items-center bg-white border-[1.5px] border-sky-100 rounded-full shadow-[0_8px_40px_rgba(14,165,233,0.10)] overflow-hidden transition-all duration-200 focus-within:border-sky-400 focus-within:shadow-[0_8px_40px_rgba(14,165,233,0.18)]">
                    <span class="pl-5 pr-3 text-slate-400"><i class="bi bi-search"></i></span>
                    <input type="text" name="q"
                        class="flex-1 py-3.5 text-sm text-slate-800 bg-transparent outline-none placeholder:text-slate-400 font-sora"
                        placeholder="Cari judul, penulis, atau kategori…" value="{{ request('q') }}">
                    <button type="submit"
                        class="m-[5px] px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold rounded-full transition-all duration-200 hover:scale-[1.02]">
                        Cari
                    </button>
                </div>
            </form>

            <div class="flex flex-wrap gap-3 justify-center mt-6">
                <a href="#buku"
                    class="flex items-center gap-2 px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-full transition-all duration-200 hover:-translate-y-0.5">
                    <i class="bi bi-grid-3x3-gap"></i> Jelajahi Buku
                </a>
                <a href="/riwayat"
                    class="flex items-center gap-2 px-6 py-2.5 bg-white border-[1.5px] border-sky-100 hover:border-sky-400 hover:bg-sky-50 text-slate-600 text-sm font-medium rounded-full transition-all duration-200">
                    <i class="bi bi-clock-history"></i> Riwayat Saya
                </a>
            </div>

            <div
                class="bob absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 text-slate-400">
                <span class="text-[0.65rem] tracking-[0.18em] uppercase">Scroll</span>
                <i class="bi bi-chevron-down text-base"></i>
            </div>

        </section>

        {{-- ===== BOOK LIST ===== --}}
        <section id="buku" class="max-w-6xl mx-auto px-6 pb-24">

            <h2 class="font-serif-display text-3xl text-slate-900 mb-6">Koleksi Buku</h2>

            {{-- Filter pills --}}
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="/"
                    class="px-4 py-1.5 rounded-full text-xs font-semibold border-[1.5px] transition-all duration-200
                    {{ !request('kategori') ? 'bg-sky-500 text-white border-sky-500' : 'bg-white text-slate-500 border-sky-100 hover:border-sky-400 hover:text-sky-600' }}">
                    Semua
                </a>
                @foreach (['Novel', 'Teknologi', 'Sejarah'] as $kategori)
                    <a href="/?kategori={{ $kategori }}"
                        class="px-4 py-1.5 rounded-full text-xs font-semibold border-[1.5px] transition-all duration-200
                        {{ request('kategori') == $kategori ? 'bg-sky-500 text-white border-sky-500' : 'bg-white text-slate-500 border-sky-100 hover:border-sky-400 hover:text-sky-600' }}">
                        {{ $kategori }}
                    </a>
                @endforeach
            </div>

            {{-- Book grid --}}
            @if ($books->isEmpty())
                <div class="text-center py-24 text-slate-400">
                    <i class="bi bi-book text-5xl block mb-4"></i>
                    <p class="text-sm">Belum ada buku yang tersedia.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    @foreach ($books as $book)
                        <div
                            class="bg-white border-[1.5px] border-sky-50 rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_48px_rgba(14,165,233,0.12)] hover:border-sky-100 group">

                            <div class="relative overflow-hidden h-48">
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            <div class="p-4">
                                <span
                                    class="inline-block text-[0.65rem] font-semibold tracking-wide uppercase text-sky-600 bg-sky-50 border border-sky-100 rounded-full px-2.5 py-0.5 mb-2">
                                    {{ $book->kategori }}
                                </span>

                                <h3 class="font-serif-display text-base text-slate-900 leading-snug line-clamp-2 mb-1">
                                    {{ $book->judul }}
                                </h3>

                                <p class="text-xs text-slate-400 mb-2">{{ $book->penulis }}</p>

                                <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-4">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ $book->stok > 0 ? 'bg-green-400' : 'bg-slate-200' }}"></span>
                                    {{ $book->stok > 0 ? $book->stok . ' stok tersedia' : 'Stok habis' }}
                                </div>

                                <div class="space-y-2">
                                    <a href="/books/{{ $book->slug }}"
                                        class="block text-center py-2 rounded-full text-xs font-semibold bg-sky-500 hover:bg-sky-600 text-white transition-colors duration-200">
                                        Lihat Detail
                                    </a>

                                    @auth
                                        @if ($book->stok > 0)
                                            <button
                                                onclick="openModal(
                                                    '{{ $book->id }}',
                                                    '{{ $book->judul }}',
                                                    '{{ $book->penulis }}',
                                                    '{{ $book->kategori }}',
                                                    '{{ asset('storage/' . $book->cover) }}'
                                                )"
                                                class="w-full py-2 rounded-full text-xs font-medium text-sky-600 border-[1.5px] border-sky-200 hover:bg-sky-50 hover:border-sky-400 transition-all duration-200">
                                                Pinjam Buku
                                            </button>
                                        @else
                                            <button disabled
                                                class="w-full py-2 rounded-full text-xs font-medium text-slate-400 bg-slate-100 cursor-not-allowed">
                                                Stok Habis
                                            </button>
                                        @endif
                                    @else
                                        <a href="/admin/login"
                                            class="block text-center py-2 rounded-full text-xs font-medium bg-rose-50 text-rose-500 border-[1.5px] border-rose-100 hover:bg-rose-100 transition-colors duration-200">
                                            Login dulu
                                        </a>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </section>

    </div>

    {{-- ========== MODAL (logic original, style Tailwind) ========== --}}
    <div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">

        <div class="modal-pop bg-white w-full max-w-md rounded-3xl p-7 shadow-[0_32px_80px_rgba(12,35,64,0.18)]">

            <h2 class="font-serif-display text-2xl text-slate-900 mb-5">Pinjam Buku</h2>

            {{-- Preview --}}
            <div class="flex gap-4 items-start bg-sky-50 border border-sky-100 rounded-2xl p-4 mb-5">
                <img id="modal_cover" class="w-14 h-20 object-cover rounded-lg flex-shrink-0">
                <div>
                    <h3 id="modal_judul" class="font-semibold text-sm text-slate-900 mb-1"></h3>
                    <p id="modal_penulis" class="text-xs text-slate-400 mb-2"></p>
                    <span id="modal_kategori"
                        class="inline-block text-[0.65rem] font-semibold tracking-wide uppercase text-sky-600 bg-white border border-sky-200 rounded-full px-2.5 py-0.5">
                    </span>
                </div>
            </div>

            {{-- User info --}}
            @auth
                <div
                    class="bg-slate-50 border border-slate-100 rounded-xl p-3.5 text-sm text-slate-600 mb-5 leading-relaxed">
                    <p><strong class="text-slate-800">Nama:</strong> {{ auth()->user()->name }}</p>
                    <p><strong class="text-slate-800">Kelas:</strong> {{ auth()->user()->kelas }}</p>
                    <p><strong class="text-slate-800">Jurusan:</strong> {{ auth()->user()->jurusan }}</p>
                </div>
            @endauth

            <form id="modal_form" method="POST">
                @csrf

                <label class="block text-[0.72rem] font-semibold tracking-widest uppercase text-slate-500 mb-1.5">
                    Lama Pinjam
                </label>
                <select name="lama_hari" id="lama_hari"
                    class="w-full font-sora text-sm text-slate-800 px-4 py-2.5 border-[1.5px] border-sky-100 focus:border-sky-400 rounded-xl bg-white outline-none transition-colors duration-200 mb-3"
                    onchange="updateTanggal()">
                    @for ($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}">{{ $i }} Hari</option>
                    @endfor
                </select>

                <p class="text-sm text-slate-500 mb-6">
                    Tanggal kembali:
                    <span id="tanggal_kembali" class="font-semibold text-sky-600"></span>
                </p>

                <div class="flex justify-end gap-2.5">
                    <button type="button" onclick="closeModal()"
                        class="px-5 py-2.5 rounded-full border-[1.5px] border-sky-100 hover:bg-sky-50 text-slate-600 text-sm font-medium transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-full bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold transition-colors duration-200">
                        Pinjam
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- ========== SCRIPTS (logic original dipertahankan 1:1) ========== --}}
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
    </script>

</x-app>
