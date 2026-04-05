<nav class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between gap-4">

        {{-- Logo --}}
        <h1 class="font-bold text-xl text-blue-600">
            Perpus<span class="text-gray-800">Ku</span>
        </h1>

        {{-- Search --}}
        <form action="/" method="GET" class="flex-1 max-w-md">
            <input 
                type="text" 
                name="search"
                placeholder="Cari buku..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </form>

        {{-- Menu --}}
        <div class="flex items-center gap-4">
            <a href="/" class="text-gray-600 hover:text-blue-500 transition">
                Home
            </a>

            <a href="/admin"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                Admin
            </a>
        </div>

    </div>
</nav>