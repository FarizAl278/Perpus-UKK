<x-app>

    <style>
        [x-cloak] { display: none !important; }
        @keyframes slideInToast { from { opacity: 0; transform: translateX(20px) } to { opacity: 1; transform: translateX(0) } }
        .toast-in { animation: slideInToast 0.3s ease; }
        .font-serif-display { font-family: 'DM Serif Display', serif; }
        .font-sora { font-family: 'Sora', sans-serif; }
    </style>

    {{-- ========== TOAST ========== --}}
    @if (session('success'))
        <div id="toast-success" class="toast-in fixed top-5 right-5 z-[70] flex items-center gap-2.5 bg-white/90 backdrop-blur-md border border-emerald-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium text-emerald-800 font-sora">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div id="toast-error" class="toast-in fixed top-5 right-5 z-[70] flex items-center gap-2.5 bg-white/90 backdrop-blur-md border border-rose-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium text-rose-800 font-sora">
            <i class="bi bi-x-circle-fill text-rose-500"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ========== BACKGROUND (TEMA AWAN) + NAVBAR SPACING ========== --}}
    <div class="min-h-screen relative font-sora"
         style="background: radial-gradient(70% 70% at 50% 30%, #d6f0ff 0%, #f7fbff 100%);">

        {{-- Cloud Blobs Decorative --}}
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/50 rounded-full blur-3xl -z-10 translate-x-1/4 -translate-y-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-sky-200/30 rounded-full blur-3xl -z-10 -translate-x-1/4 translate-y-1/4"></div>

        {{-- CONTENT WRAPPER (pt-28 untuk navbar float) --}}
        <div class="max-w-5xl mx-auto px-6 pt-28 pb-16">

            {{-- CARD DETAIL --}}
            <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-6 md:p-8 md:flex gap-8">

                {{-- COVER --}}
                <div class="md:w-1/3">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg shadow-sky-200/40 group">
                        <img src="{{ asset('storage/' . $book->cover) }}"
                             alt="{{ $book->judul }}"
                             class="w-full h-72 md:h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>

                {{-- INFO --}}
                <div class="md:w-2/3 mt-6 md:mt-0">
                    <span class="inline-block text-[0.65rem] font-semibold tracking-wide uppercase text-sky-600 bg-sky-50 border border-sky-100 rounded-full px-3 py-1 mb-3">
                        {{ $book->kategori }}
                    </span>

                    <h1 class="font-serif-display text-2xl md:text-3xl text-slate-900 leading-tight">
                        {{ $book->judul }}
                    </h1>

                    <p class="text-slate-500 mt-2 text-sm md:text-base">
                        oleh <span class="font-medium text-slate-700">{{ $book->penulis }}</span>
                    </p>

                    {{-- DETAIL GRID --}}
                    <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-sky-50/60 border border-sky-100 rounded-xl px-4 py-3">
                            <p class="text-xs text-slate-400 font-medium">Penerbit</p>
                            <p class="font-semibold text-slate-700 mt-0.5">{{ $book->penerbit }}</p>
                        </div>
                        <div class="bg-sky-50/60 border border-sky-100 rounded-xl px-4 py-3">
                            <p class="text-xs text-slate-400 font-medium">Tahun Terbit</p>
                            <p class="font-semibold text-slate-700 mt-0.5">{{ $book->tahun_terbit }}</p>
                        </div>
                        <div class="bg-sky-50/60 border border-sky-100 rounded-xl px-4 py-3 col-span-2">
                            <p class="text-xs text-slate-400 font-medium">Ketersediaan</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="w-2 h-2 rounded-full {{ $book->stok > 0 ? 'bg-emerald-400' : 'bg-slate-300' }}"></span>
                                <p class="font-semibold {{ $book->stok > 0 ? 'text-emerald-600' : 'text-slate-500' }}">
                                    {{ $book->stok > 0 ? $book->stok . ' stok tersedia' : 'Stok habis' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="mt-7 flex flex-wrap gap-3">
                        @auth
                            @if ($book->stok > 0)
                                <button onclick="openModal(
                                    '{{ $book->id }}',
                                    '{{ addslashes($book->judul) }}',
                                    '{{ addslashes($book->penulis) }}',
                                    '{{ $book->kategori }}',
                                    '{{ asset('storage/' . $book->cover) }}'
                                )"
                                class="px-6 py-2.5 rounded-full bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold transition-all duration-200 shadow-md shadow-sky-200/50 hover:shadow-lg hover:-translate-y-0.5">
                                    Pinjam Buku
                                </button>
                            @else
                                <button disabled class="px-6 py-2.5 rounded-full bg-slate-200 text-slate-400 text-sm font-medium cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <a href="/loginuser"
                               class="px-6 py-2.5 rounded-full bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold transition-all duration-200 shadow-md shadow-rose-200/50">
                                Login dulu
                            </a>
                        @endauth

                        <a href="/"
                           class="px-5 py-2.5 rounded-full border-[1.5px] border-sky-200 text-sky-600 hover:bg-sky-50 text-sm font-medium transition-all duration-200">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- SINOPSIS --}}
            <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_8px_32px_rgba(14,165,233,0.08)] p-6 md:p-8 mt-6">
                <h2 class="font-serif-display text-xl text-slate-900 mb-4">Sinopsis</h2>
                <div class="text-slate-600 leading-relaxed text-sm md:text-base space-y-3">
                    {!! nl2br(e($book->sinopsis)) !!}
                </div>
            </div>

            {{-- RELATED BOOKS --}}
            @if(isset($relatedBooks) && $relatedBooks->count() > 0)
            <div class="mt-10">
                <h2 class="font-serif-display text-xl text-slate-900 mb-5">Buku Serupa</h2>
                <div class="flex gap-4 overflow-x-auto pb-4 snap-x scrollbar-hide">
                    @foreach ($relatedBooks as $item)
                        <a href="/books/{{ $item->slug }}"
                           class="min-w-[170px] bg-white/80 backdrop-blur-md border border-white/60 rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(14,165,233,0.15)] snap-start group">

                            <div class="relative overflow-hidden h-44">
                                <img src="{{ asset('storage/' . $item->cover) }}" alt="{{ $item->judul }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>

                            <div class="p-4">
                                <span class="inline-block text-[0.6rem] font-semibold uppercase text-sky-600 bg-sky-50 border border-sky-100 rounded-full px-2 py-0.5 mb-2">
                                    {{ $item->kategori }}
                                </span>
                                <h3 class="font-serif-display text-sm text-slate-900 leading-snug line-clamp-2 mb-1">
                                    {{ $item->judul }}
                                </h3>
                                <p class="text-xs text-slate-400">{{ $item->penulis }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- ========== MODAL (LOGIC 100% SAMA, STYLE DISESUAIKAN) ========== --}}
    <div id="modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center z-[80] p-4">
        <div class="modal-pop bg-white w-full max-w-md rounded-3xl p-7 shadow-[0_32px_80px_rgba(12,35,64,0.18)] border border-white/60">

            <div class="flex items-center justify-between mb-5">
                <h2 class="font-serif-display text-2xl text-slate-900">Pinjam Buku</h2>
                <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            {{-- Preview Buku --}}
            <div class="flex gap-4 items-start bg-sky-50 border border-sky-100 rounded-2xl p-4 mb-5">
                <img id="modal_cover" class="w-14 h-20 object-cover rounded-lg flex-shrink-0 bg-slate-100">
                <div>
                    <h3 id="modal_judul" class="font-semibold text-sm text-slate-900 mb-1"></h3>
                    <p id="modal_penulis" class="text-xs text-slate-400 mb-2"></p>
                    <span id="modal_kategori" class="inline-block text-[0.65rem] font-semibold tracking-wide uppercase text-sky-600 bg-white border border-sky-200 rounded-full px-2.5 py-0.5">
                    </span>
                </div>
            </div>

            {{-- User Info --}}
            @auth
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-3.5 text-sm text-slate-600 mb-5 leading-relaxed">
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

    {{-- ========== SCRIPTS (LOGIC ORIGINAL 1:1) ========== --}}
    <script>
        // TOAST AUTO HIDE
        setTimeout(() => {
            document.getElementById('toast-success')?.remove();
            document.getElementById('toast-error')?.remove();
        }, 3000);

        // MODAL FUNCTIONS - LOGIC SAMA PERSIS
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

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</x-app>