<nav class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between gap-4">

        {{-- Logo --}}
        <h1 class="font-bold text-xl text-blue-600">
            Perpus<span class="text-gray-800">Ku</span>
        </h1>

        {{-- Search --}}
        <form action="/" method="GET" class="flex-1 max-w-md">
            <input type="text" name="search" placeholder="Cari buku..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </form>

        {{-- Menu --}}
        <div class="flex items-center gap-4 relative">

            <a href="/" class="text-gray-600 hover:text-blue-500 transition">
                Home
            </a>

            {{-- AUTH --}}
            @auth
                <div class="relative">
                    {{-- Tambahkan id "dropdown-button" untuk mempermudah deteksi klik --}}
                    <button id="dropdown-button" onclick="toggleDropdown()"
                        class="flex items-center gap-2 text-gray-700 hover:text-blue-500 focus:outline-none">

                        <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <span class="text-sm">
                            {{ auth()->user()->name }}
                        </span>
                    </button>

                    {{-- Dropdown --}}
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50">

                        <a href="/profile" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile
                        </a>

                        <a href="/riwayat" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Riwayat
                        </a>

                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="/admin/login"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    Login
                </a>
            @endguest

        </div>
    </div>
</nav>
