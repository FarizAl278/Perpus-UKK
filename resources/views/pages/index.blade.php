<x-app>

@if (session('success'))
            <div id="toast-success"
                class="fixed top-5 right-5 z-50 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-slide-in">

                <span><i class="bi bi-check-square-fill"></i></span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="toast-error"
                class="fixed top-5 right-5 z-50 bg-red-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-slide-in">

                <span><i class="bi bi-x-square-fill"></i></span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">Daftar Buku</h1>

        {{-- KATEGORI --}}
        <div class="mb-6 flex gap-3 flex-wrap">
            <a href="/"
                class="px-4 py-2 rounded-full text-sm 
                {{ request('kategori') ? 'bg-gray-200 text-gray-700' : 'bg-blue-500 text-white' }}">
                Semua
            </a>

            @foreach (['Novel', 'Teknologi', 'Sejarah'] as $kategori)
                <a href="/?kategori={{ $kategori }}"
                    class="px-4 py-2 rounded-full text-sm 
                    {{ request('kategori') == $kategori ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    {{ $kategori }}
                </a>
            @endforeach
        </div>

        {{-- LIST BUKU --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden group">

                    <img src="{{ asset('storage/' . $book->cover) }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition">

                    <div class="p-4">
                        <h2 class="font-semibold text-lg line-clamp-2">
                            {{ $book->judul }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $book->penulis }}
                        </p>

                        <span class="inline-block mt-2 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                            {{ $book->kategori }}
                        </span>

                        <p class="text-sm mt-2">
                            Stok: {{ $book->stok }}
                        </p>

                        <div class="mt-4 space-y-2">

                            {{-- DETAIL --}}
                            <a href="/books/{{ $book->slug }}"
                                class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm transition">
                                Lihat Detail
                            </a>

                            {{-- PINJAM --}}
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
                                        class="w-full border border-gray-300 hover:bg-gray-100 py-2 rounded-lg text-sm transition">
                                        Pinjam Buku
                                    </button>
                                @else
                                    <button disabled
                                        class="w-full border border-gray-300 bg-gray-300 text-white py-2 rounded-lg text-sm">
                                        Stok Habis
                                    </button>
                                @endif
                            @else
                                <a href="/admin/login"
                                    class="block text-center bg-yellow-500 text-white py-2 rounded-lg text-sm">
                                    Login dulu
                                </a>
                            @endauth

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- MODAL --}}
        <div id="modal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-md rounded-2xl p-6">

                <h2 class="text-lg font-bold mb-4">Pinjam Buku</h2>

                {{-- PREVIEW BUKU --}}
                <div class="flex gap-4 mb-4">
                    <img id="modal_cover" class="w-16 h-24 object-cover rounded">

                    <div>
                        <h3 id="modal_judul" class="font-semibold text-sm"></h3>
                        <p id="modal_penulis" class="text-xs text-gray-500"></p>
                        <span id="modal_kategori"
                            class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded"></span>
                    </div>
                </div>

                {{-- PREVIEW USER --}}
                @auth
                    <div class="bg-gray-100 p-3 rounded mb-4 text-sm">
                        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Kelas:</strong> {{ auth()->user()->kelas }}</p>
                        <p><strong>Jurusan:</strong> {{ auth()->user()->jurusan }}</p>
                    </div>
                @endauth

                <form id="modal_form" method="POST">
                    @csrf

                    <label class="text-sm">Lama Pinjam</label>
                    <select name="lama_hari" id="lama_hari"
                        class="w-full border p-2 rounded mb-3"
                        onchange="updateTanggal()">

                        @for ($i = 1; $i <= 7; $i++)
                            <option value="{{ $i }}">{{ $i }} Hari</option>
                        @endfor

                    </select>

                    <p class="text-sm text-gray-600 mb-4">
                        Tanggal kembali:
                        <span id="tanggal_kembali" class="font-medium"></span>
                    </p>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded">
                            Batal
                        </button>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Pinjam
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</x-app>