<x-app>
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">Daftar Buku</h1>

        <div class="mb-6 flex gap-3 flex-wrap">

            {{-- Semua --}}
            <a href="/"
                class="px-4 py-2 rounded-full text-sm 
       {{ request('kategori') ? 'bg-gray-200 text-gray-700' : 'bg-blue-500 text-white' }}">
                Semua
            </a>

            {{-- Kategori --}}
            @foreach (['Novel', 'Teknologi', 'Sejarah'] as $kategori)
                <a href="/?kategori={{ $kategori }}"
                    class="px-4 py-2 rounded-full text-sm 
           {{ request('kategori') == $kategori ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                    {{ $kategori }}
                </a>
            @endforeach

        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden group">

                    {{-- Cover --}}
                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-48 object-cover group-hover:scale-105 transition">

                    <div class="p-4">
                        {{-- Judul --}}
                        <h2 class="font-semibold text-lg line-clamp-2">
                            {{ $book->judul }}
                        </h2>

                        {{-- Penulis --}}
                        <p class="text-sm text-gray-500">
                            {{ $book->penulis }}
                        </p>

                        {{-- Kategori --}}
                        <span class="inline-block mt-2 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                            {{ $book->kategori }}
                        </span>

                        {{-- Stok --}}
                        <p class="text-sm mt-2">
                            Stok: {{ $book->stok }}
                        </p>

                        {{-- BUTTON --}}
                        <div class="mt-4 space-y-2">

                            {{-- Detail --}}
                            <a href="/books/{{ $book->slug }}"
                                class="block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm transition">
                                Lihat Detail
                            </a>

                            {{-- Pinjam --}}
                            <button
                                class="w-full border border-gray-300 hover:bg-gray-100 py-2 rounded-lg text-sm transition">
                                Pinjam Buku
                            </button>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app>
