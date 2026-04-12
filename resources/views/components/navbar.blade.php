<style>
    .font-serif-display {
        font-family: 'DM Serif Display', serif;
    }

    nav,
    nav * {
        font-family: 'Sora', sans-serif;
    }
</style>

<nav class="fixed top-0 inset-x-0 z-40 px-4 pt-4">
    <div class="max-w-6xl mx-auto">

        <div
            class="bg-white/70 backdrop-blur-md border border-sky-100/80 rounded-2xl px-5 py-3 flex items-center justify-between gap-6 shadow-[0_4px_24px_rgba(14,165,233,0.08)]">

            {{-- LOGO --}}
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('logo-naked-libris.png') }}" class="w-8 h-8">
                <a href="/" class="font-serif-display text-xl text-slate-900">
                    Libr<span class="text-sky-500 italic">is</span>
                </a>
            </div>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center gap-1 text-sm">
                <a href="/"
                    class="px-3.5 py-2 rounded-xl font-medium
                   {{ request()->is('/') ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:bg-slate-50' }}">
                    Home
                </a>
                <a href="/riwayat"
                    class="px-3.5 py-2 rounded-xl font-medium
                   {{ request()->is('riwayat') ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:bg-slate-50' }}">
                    Riwayat
                </a>
            </div>

            {{-- AUTH DESKTOP --}}
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="/profile" class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl hover:bg-sky-50">
                        <div class="w-7 h-7 bg-sky-500 text-white rounded-full flex items-center justify-center text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm text-slate-700 hidden sm:block">
                            {{ auth()->user()->name }}
                        </span>
                    </a>

                    <form action="/logout" method="POST">
                        @csrf
                        <button class="px-3 py-1.5 text-sm text-slate-400 hover:text-rose-500">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="loginuser" class="px-4 py-2 bg-sky-500 text-white text-sm rounded-full">
                        Login
                    </a>
                @endauth
            </div>

            {{-- HAMBURGER --}}
            <button onclick="toggleMenu()" class="md:hidden text-xl text-slate-600">
                <i class="bi bi-list"></i>
            </button>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobileMenu"
            class="hidden mt-3 bg-white/90 backdrop-blur-md border border-sky-100 rounded-2xl p-4 shadow">

            <div class="flex flex-col gap-2 text-sm">
                <a href="/" class="px-3 py-2 rounded-lg hover:bg-sky-50">Home</a>
                <a href="/riwayat" class="px-3 py-2 rounded-lg hover:bg-sky-50">Riwayat</a>

                <hr class="my-2">

                @auth
                    <a href="/profile" class="px-3 py-2 rounded-lg hover:bg-sky-50">
                        Profile ({{ auth()->user()->name }})
                    </a>

                    <form action="/logout" method="POST">
                        @csrf
                        <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-rose-50 text-rose-500">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/admin/login" class="px-3 py-2 rounded-lg bg-sky-500 text-white text-center">
                        Login
                    </a>
                @endauth
            </div>
        </div>

    </div>
</nav>
