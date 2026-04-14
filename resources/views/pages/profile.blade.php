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
        .profile-avatar { transition: all 0.3s ease; }
        .profile-avatar:hover { transform: scale(1.05); box-shadow: 0 20px 40px rgba(14,165,233,0.2); }
    </style>

    {{-- ========== SKY BACKGROUND ========== --}}
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

    {{-- ========== MAIN WRAPPER ========== --}}
    <div x-data="profilePage()" class="relative z-10 min-h-screen">
        <div class="max-w-6xl mx-auto px-6 pt-36 pb-24">
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-3"><span class="block w-6 h-px bg-sky-400"></span><p class="text-[0.68rem] font-semibold tracking-[0.22em] uppercase text-sky-500">Akun Saya</p></div>
                <h1 class="font-serif-display text-4xl text-slate-900">Profil Pengguna</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- LEFT COLUMN --}}
                <div class="space-y-6">
                    <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-8 text-center">
                        <div class="relative inline-block mb-4">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-sky-400 to-blue-500 p-1 profile-avatar cursor-pointer mx-auto" @click="showAvatarModal = true">
                                <div class="w-full h-full rounded-full bg-slate-100 flex items-center justify-center overflow-hidden">
                                    @if(auth()->user()->avatar) <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                                    @else <span class="text-4xl font-bold text-sky-500">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span> @endif
                                </div>
                            </div>
                            <div class="absolute bottom-1 right-1 w-6 h-6 bg-emerald-400 border-2 border-white rounded-full"></div>
                        </div>
                        <h2 class="font-serif-display text-2xl text-slate-900 mb-1">{{ auth()->user()->name }}</h2>
                        <p class="text-slate-500 text-sm mb-4">{{ auth()->user()->email }}</p>
                        <div class="flex items-center justify-center gap-2 text-sm text-slate-600 mb-2"><i class="bi bi-geo-alt text-sky-400"></i><span>{{ auth()->user()->kelas }} - {{ auth()->user()->jurusan }}</span></div>
                        <div class="flex items-center justify-center gap-2 text-sm text-slate-600"><i class="bi bi-telephone text-sky-400"></i><span>{{ auth()->user()->no_tlp ?? 'Belum diatur' }}</span></div>
                        <button type="button" @click="showEditModal = true" class="mt-6 w-full py-2.5 rounded-full bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold transition-all duration-200 shadow-md shadow-sky-200/50">Edit Profil</button>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-6">
                        <h3 class="font-serif-display text-lg text-slate-900 mb-4">Statistik Peminjaman</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-sky-50/60 rounded-xl border border-sky-100"><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center"><i class="bi bi-book text-sky-500"></i></div><div><p class="text-xs text-slate-400">Total Pinjam</p><p class="font-bold text-slate-900">{{ $stats['total'] ?? 0 }}</p></div></div></div>
                            <div class="flex items-center justify-between p-3 bg-amber-50/60 rounded-xl border border-amber-100"><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center"><i class="bi bi-hourglass-split text-amber-500"></i></div><div><p class="text-xs text-slate-400">Sedang Aktif</p><p class="font-bold text-slate-900">{{ $stats['aktif'] ?? 0 }}</p></div></div></div>
                            <div class="flex items-center justify-between p-3 bg-emerald-50/60 rounded-xl border border-emerald-100"><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center"><i class="bi bi-check-circle text-emerald-500"></i></div><div><p class="text-xs text-slate-400">Selesai</p><p class="font-bold text-slate-900">{{ $stats['selesai'] ?? 0 }}</p></div></div></div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-serif-display text-xl text-slate-900">Informasi Pribadi</h3>
                            <button type="button" @click="showEditModal = true" class="text-sky-500 hover:text-sky-700 text-sm font-medium flex items-center gap-1"><i class="bi bi-pencil-square"></i> Ubah Email & No. HP</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1"><p class="text-xs text-slate-400 uppercase tracking-wide">Nama Lengkap</p><p class="font-semibold text-slate-900">{{ auth()->user()->name }}</p></div>
                            <div class="space-y-1"><p class="text-xs text-slate-400 uppercase tracking-wide">Email</p><p class="font-semibold text-slate-900">{{ auth()->user()->email }}</p></div>
                            <div class="space-y-1"><p class="text-xs text-slate-400 uppercase tracking-wide">Nomor Telepon</p><p class="font-semibold text-slate-900">{{ auth()->user()->no_tlp ?? '-' }}</p></div>
                            <div class="space-y-1"><p class="text-xs text-slate-400 uppercase tracking-wide">Kelas</p><p class="font-semibold text-slate-900">{{ auth()->user()->kelas ?? '-' }}</p></div>
                            <div class="space-y-1"><p class="text-xs text-slate-400 uppercase tracking-wide">Jurusan</p><p class="font-semibold text-slate-900">{{ auth()->user()->jurusan ?? '-' }}</p></div>
                            <div class="space-y-1"><p class="text-xs text-slate-400 uppercase tracking-wide">Bergabung Sejak</p><p class="font-semibold text-slate-900">{{ auth()->user()->created_at->format('d M Y') }}</p></div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-8">
                        <h3 class="font-serif-display text-xl text-slate-900 mb-6">Keamanan Akun</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center"><i class="bi bi-lock text-slate-500"></i></div>
                                    <div><p class="font-semibold text-slate-900 text-sm">Password</p><p class="text-xs text-slate-400">Terakhir diubah {{ auth()->user()->updated_at->diffForHumans() }}</p></div>
                                </div>
                                <button type="button" @click="showPasswordModal = true" class="px-4 py-2 rounded-full border border-sky-200 text-sky-600 hover:bg-sky-50 text-sm font-medium transition-all duration-200">Ubah Password</button>
                            </div>
                        </div>
                    </div>

                    @if(isset($recentActivity) && $recentActivity->count() > 0)
                    <div class="bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-8">
                        <h3 class="font-serif-display text-xl text-slate-900 mb-6">Aktivitas Terbaru</h3>
                        <div class="space-y-3">
                            @foreach($recentActivity as $activity)
                            <div class="flex items-center gap-4 p-4 bg-sky-50/40 rounded-xl border border-sky-100 hover:bg-sky-50/60 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center flex-shrink-0"><i class="bi bi-book text-sky-500"></i></div>
                                <div class="flex-1 min-w-0"><p class="font-semibold text-slate-900 text-sm truncate">{{ $activity->book->judul }}</p><p class="text-xs text-slate-400">{{ $activity->created_at->format('d M Y, H:i') }}</p></div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-600 border border-sky-200">{{ ucfirst($activity->status) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ========== MODAL: EDIT PROFILE (RESTRICTED) ========== --}}
        <div x-show="showEditModal" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="showEditModal = false" @keydown.escape.window="showEditModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div x-show="showEditModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-3" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="bg-white w-full max-w-md rounded-3xl shadow-[0_32px_80px_rgba(12,35,64,0.18)] overflow-hidden">
                <div class="flex items-center justify-between px-7 pt-6 pb-4 border-b border-slate-100">
                    <h2 class="font-serif-display text-2xl text-slate-900">Edit Kontak</h2>
                    <button type="button" @click="showEditModal = false" class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition"><i class="bi bi-x-lg text-sm"></i></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" class="p-7 space-y-5">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition text-slate-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Telepon</label>
                        <input type="text" name="no_tlp" value="{{ old('no_tlp', auth()->user()->no_tlp) }}" placeholder="081234567890" class="w-full px-4 py-2.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition text-slate-700">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="showEditModal = false" class="flex-1 px-5 py-2.5 rounded-full border-[1.5px] border-sky-200 text-sky-600 hover:bg-sky-50 text-sm font-medium transition">Batal</button>
                        <button type="submit" class="flex-1 px-5 py-2.5 rounded-full bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold transition shadow-md shadow-sky-200/50">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ========== MODAL: CHANGE PASSWORD ========== --}}
        <div x-show="showPasswordModal" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="showPasswordModal = false" @keydown.escape.window="showPasswordModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div x-show="showPasswordModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-3" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="bg-white w-full max-w-md rounded-3xl shadow-[0_32px_80px_rgba(12,35,64,0.18)] overflow-hidden">
                <div class="flex items-center justify-between px-7 pt-6 pb-4 border-b border-slate-100">
                    <h2 class="font-serif-display text-2xl text-slate-900">Ubah Password</h2>
                    <button type="button" @click="showPasswordModal = false" class="w-8 h-8 flex items-center justify-center rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition"><i class="bi bi-x-lg text-sm"></i></button>
                </div>
                <form action="{{ route('profile.password') }}" method="POST" class="p-7 space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Lama</label>
                        <input type="password" name="old_password" required class="w-full px-4 py-2.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition text-slate-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                        <input type="password" name="new_password" required minlength="8" class="w-full px-4 py-2.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition text-slate-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" required minlength="8" class="w-full px-4 py-2.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition text-slate-700">
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="showPasswordModal = false" class="flex-1 px-5 py-2.5 rounded-full border-[1.5px] border-sky-200 text-sky-600 hover:bg-sky-50 text-sm font-medium transition">Batal</button>
                        <button type="submit" class="flex-1 px-5 py-2.5 rounded-full bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold transition shadow-md shadow-sky-200/50">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ========== MODAL: VIEW AVATAR ========== --}}
        <div x-show="showAvatarModal" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="showAvatarModal = false" @keydown.escape.window="showAvatarModal = false" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[70] flex items-center justify-center p-4">
            <div x-show="showAvatarModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative">
                @if(auth()->user()->avatar) <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="max-w-md max-h-[80vh] rounded-2xl shadow-2xl">
                @else <div class="w-64 h-64 rounded-full bg-gradient-to-br from-sky-400 to-blue-500 flex items-center justify-center shadow-2xl"><span class="text-8xl font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span></div> @endif
                <button type="button" @click="showAvatarModal = false" class="absolute -top-4 -right-4 w-10 h-10 rounded-full bg-white text-slate-600 hover:bg-slate-100 flex items-center justify-center shadow-lg transition"><i class="bi bi-x-lg"></i></button>
            </div>
        </div>

    </div>

    <script>
        setTimeout(() => { document.getElementById('toast-success')?.remove(); document.getElementById('toast-error')?.remove(); }, 3000);
        function profilePage() {
            return { showEditModal: false, showPasswordModal: false, showAvatarModal: false }
        }
    </script>

</x-app>