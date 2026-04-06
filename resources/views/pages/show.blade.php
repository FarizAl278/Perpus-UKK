<x-app>
    <div class="bg-gray-100 min-h-screen py-10">

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

        <div class="max-w-5xl mx-auto px-6">

            {{-- Card Detail --}}
            <div class="bg-white rounded-2xl shadow p-6 md:flex gap-6">

                {{-- Cover --}}
                <div class="md:w-1/3">
                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-72 object-cover rounded-xl">
                </div>

                {{-- Info --}}
                <div class="md:w-2/3 mt-4 md:mt-0">

                    <h1 class="text-2xl md:text-3xl font-bold">
                        {{ $book->judul }}
                    </h1>

                    <p class="text-gray-500 mt-1">
                        {{ $book->penulis }}
                    </p>

                    {{-- Badge kategori --}}
                    <span class="inline-block mt-3 text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        {{ $book->kategori }}
                    </span>

                    {{-- Detail --}}
                    <div class="mt-4 space-y-1 text-sm text-gray-700">
                        <p><span class="font-medium">Penerbit:</span> {{ $book->penerbit }}</p>
                        <p><span class="font-medium">Tahun:</span> {{ $book->tahun_terbit }}</p>
                        <p><span class="font-medium">Stok:</span> {{ $book->stok }}</p>
                    </div>

                    {{-- Button --}}
                    <div class="mt-6 flex gap-3">

                        <form action="/pinjam/{{ $book->id }}" method="POST">
                            @csrf
                            @if ($book->stok > 0)
                                <button onclick="openModal()"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg text-sm">
                                    Pinjam Buku
                                </button>
                            @else
                                <button disabled
                                    class="bg-gray-300 cursor-not-allowed text-gray-500 px-5 py-2 rounded-lg text-sm">
                                    Stok Habis
                                </button>
                            @endif
                        </form>

                        <a href="/"
                            class="border border-gray-300 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm transition">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- Sinopsis --}}
            <div class="bg-white rounded-2xl shadow p-6 mt-6">
                <h2 class="text-lg font-semibold mb-2">Sinopsis</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $book->sinopsis }}
                </p>
            </div>

            {{-- Buku Lainnya --}}
            <div class="mt-10">
                <h2 class="text-xl font-bold mb-4">Buku Lainnya</h2>

                <div class="flex gap-4 overflow-x-auto pb-4 snap-x">

                    @foreach ($relatedBooks as $item)
                        <a href="/books/{{ $item->slug }}"
                            class="min-w-[160px] bg-white rounded-xl shadow hover:shadow-lg transition snap-start group overflow-hidden">
                            <img src="{{ asset('storage/' . $item->cover) }}"
                                class="w-full h-40 object-cover rounded-t-xl group-hover:scale-105 transition">
                            <div class="p-3">
                                <p class="text-sm font-semibold line-clamp-2">
                                    {{ $item->judul }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $item->penulis }}
                                </p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</x-app>
