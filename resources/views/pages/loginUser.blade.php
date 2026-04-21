<x-html>

    @php
        $noAdmin = '6285122014247';

        $lines = [
            '*PENDAFTARAN AKUN PERPUSTAKAAN*',
            '',
            'Halo Admin, saya ingin membuat akun baru. Berikut data diri saya:',
            '',
            '- Nama: ',
            '- Email: ',
            '- Kelas: ',
            '- Jurusan: ',
            '',
            'Mohon bantuannya, terima kasih!',
        ];

        // Gabungkan array dengan karakter newline (\n)
        $pesan = implode("\n", $lines);

        $urlWa = "https://wa.me/{$noAdmin}?text=" . urlencode($pesan);
    @endphp

    <style>
        [x-cloak] {
            display: none !important;
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
    </style>

    {{-- ========== TOAST ========== --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
            class="toast-in fixed top-5 right-5 z-[60] flex items-center gap-2.5 bg-white/90 backdrop-blur-md border border-emerald-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium text-emerald-800">
            <i class="bi bi-check-circle-fill text-emerald-500"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
            class="toast-in fixed top-5 right-5 z-[60] flex items-center gap-2.5 bg-white/90 backdrop-blur-md border border-rose-200 px-5 py-3 rounded-2xl shadow-lg text-sm font-medium text-rose-800">
            <i class="bi bi-x-circle-fill text-rose-500"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ========== BACKGROUND & LAYOUT (TEMA AWAN) ========== --}}
    <div class="min-h-screen relative flex items-center justify-center px-4 py-12 overflow-hidden"
        style="background: radial-gradient(70% 70% at 50% 30%, #d6f0ff 0%, #f7fbff 100%);">

        {{-- Decorative Cloud Blobs --}}
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/60 rounded-full blur-3xl -z-10 translate-x-1/3 -translate-y-1/3">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-sky-200/40 rounded-full blur-3xl -z-10 -translate-x-1/3 translate-y-1/3">
        </div>
        <div
            class="absolute top-1/2 left-1/2 w-72 h-72 bg-white/30 rounded-full blur-2xl -z-10 -translate-x-1/2 -translate-y-1/2">
        </div>

        {{-- LOGIN CARD --}}
        <div
            class="w-full max-w-md bg-white/80 backdrop-blur-xl border border-white/70 rounded-3xl shadow-[0_12px_40px_rgba(14,165,233,0.12)] p-8 sm:p-10 transform transition duration-300 hover:shadow-[0_16px_48px_rgba(14,165,233,0.18)]">

            <div class="text-center mb-8">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-50 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg shadow-sky-300/40">
                    <img src="{{ asset('logo-naked-libris.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Login Siswa</h1>
                <p class="text-slate-500 text-sm mt-1.5">Masuk untuk meminjam & mengelola buku</p>
            </div>

            <form method="POST" action="{{ route('siswa.login.store') }}">
                @csrf

                <div class="mb-5">
                    <label for="identity" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input type="text" id="identity" name="identity" value="{{ old('identity') }}" required
                        class="w-full px-4 py-3.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition placeholder-slate-400 text-slate-700 @error('identity') border-rose-400 bg-rose-50/50 @enderror"
                        placeholder="siswa@sekolah.id">
                    @error('identity')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1.5">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6" x-data="{ show: false }">
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password" required
                            class="w-full px-4 py-3.5 rounded-xl bg-white/60 border border-slate-200 focus:border-sky-400 focus:ring-4 focus:ring-sky-100 outline-none transition placeholder-slate-400 text-slate-700 pr-12 @error('password') border-rose-400 bg-rose-50/50 @enderror"
                            placeholder="Masukkan password">
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-500 transition p-1.5 rounded-lg hover:bg-sky-50">
                            <i :class="show ? 'bi bi-eye-slash-fill text-sm' : 'bi bi-eye-fill text-sm'"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-7">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="w-4 h-4 text-sky-500 border-slate-300 rounded focus:ring-sky-400 cursor-pointer bg-white/60">
                        <label for="remember" class="ml-2.5 text-sm text-slate-600 cursor-pointer select-none">Ingat
                            saya</label>
                    </div>
                    <a href="#"
                        class="text-xs text-sky-500 hover:text-sky-700 font-medium transition hover:underline">Lupa
                        password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-sky-500 to-blue-500 hover:from-sky-600 hover:to-blue-600 active:scale-[0.98] text-white font-semibold py-3.5 rounded-xl transition duration-200 shadow-lg shadow-sky-200/50 flex items-center justify-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-200/50 text-center">
                <p class="text-xs text-slate-400">
                    Belum punya akun?
                    <a href="{{ $urlWa }}" target="_blank"
                        class="text-sky-500 hover:text-sky-700 font-medium transition hover:underline">Hubungi Petugas
                        Perpustakaan</a>
                </p>
            </div>
        </div>
    </div>
</x-html>
