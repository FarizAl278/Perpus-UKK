<x-app>
    <div class="max-w-4xl mx-auto px-4 py-8">

        <h1 class="text-2xl font-bold mb-6">Riwayat Peminjaman</h1>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($riwayat->isEmpty())
            <div class="text-center text-gray-500 py-16">
                <p class="text-lg">Kamu belum pernah meminjam buku.</p>
                <a href="/" class="mt-4 inline-block text-blue-500 hover:underline">Lihat Katalog Buku</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Buku</th>
                            <th class="px-4 py-3 text-left">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left">Tgl Kembali</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($riwayat as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>

                                {{-- Cover + Judul --}}
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('storage/' . $item->book->cover) }}"
                                            class="w-10 h-14 object-cover rounded shadow-sm">
                                        <div>
                                            <p class="font-medium">{{ $item->book->judul }}</p>
                                            <p class="text-xs text-gray-400">{{ $item->book->penulis }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                </td>

                                {{-- Badge Status --}}
                                <td class="px-4 py-3">
                                    @php
                                        $badge = match($item->status) {
                                            'dipinjam'     => 'bg-blue-100 text-blue-600',
                                            'dikembalikan' => 'bg-green-100 text-green-600',
                                            'terlambat'    => 'bg-red-100 text-red-600',
                                            default        => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-medium {{ $badge }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app>