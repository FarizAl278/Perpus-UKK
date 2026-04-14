<x-html>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap');
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        @keyframes drift { from{transform:translateX(-350px)} to{transform:translateX(calc(100vw+350px))} }
        .cloud-1{animation:drift 60s linear infinite} .cloud-2{animation:drift 80s linear -20s infinite}
        .float-anim{animation:float 6s ease-in-out infinite}
        body{font-family:'Sora',sans-serif} .font-serif-display{font-family:'DM Serif Display',serif}
    </style>

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="sky500" cx="50%" cy="30%" r="70%"><stop offset="0%" stop-color="#f1f5f9"/><stop offset="100%" stop-color="#f7fbff"/></radialGradient></defs>
            <rect width="1440" height="900" fill="url(#sky500)"/>
            <g class="cloud-1" style="opacity:0.35"><ellipse cx="180" cy="60" rx="110" ry="42" fill="#cbd5e1"/><ellipse cx="230" cy="45" rx="75" ry="38" fill="#cbd5e1"/><ellipse cx="130" cy="55" rx="65" ry="32" fill="#cbd5e1"/></g>
            <g class="cloud-2" style="opacity:0.3;transform:translateY(180px)"><ellipse cx="200" cy="55" rx="130" ry="38" fill="#94a3b8"/><ellipse cx="260" cy="38" rx="90" ry="35" fill="#94a3b8"/><ellipse cx="150" cy="50" rx="70" ry="30" fill="#94a3b8"/></g>
        </svg>
    </div>

    <div x-data="{ mx: 0, my: 0 }" @mousemove.window="mx = ($event.clientX / window.innerWidth - 0.5) * 20; my = ($event.clientY / window.innerHeight - 0.5) * 20" class="relative z-10 min-h-screen flex items-center justify-center px-6 py-20">
        <div class="text-center max-w-md">
            <div class="float-anim mb-6 relative inline-block">
                <span class="text-9xl font-serif-display text-slate-300/40 absolute -top-8 left-1/2 -translate-x-1/2 select-none">500</span>
                <div class="w-32 h-32 mx-auto bg-gradient-to-br from-slate-500 to-slate-700 rounded-3xl flex items-center justify-center shadow-xl shadow-slate-300/50 transform transition-transform duration-200" :style="`transform: translate(${mx}px, ${my}px)`">
                    <i class="bi bi-gear-wide-connected text-5xl text-white animate-spin-slow"></i>
                </div>
            </div>
            <h1 class="font-serif-display text-3xl text-slate-900 mb-3">Terjadi Kesalahan Server</h1>
            <p class="text-slate-500 mb-8 leading-relaxed">Sesuatu yang tidak terduga terjadi di balik awan. Tim kami sedang memperbaiki sistem. Coba refresh halaman atau kembali nanti.</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="/" class="px-6 py-3 rounded-full bg-sky-500 hover:bg-sky-600 text-white font-semibold transition-all duration-200 shadow-md shadow-sky-200/50 hover:-translate-y-0.5">Kembali ke Beranda</a>
                <button onclick="window.location.reload()" class="px-6 py-3 rounded-full border-[1.5px] border-slate-300 text-slate-600 hover:bg-slate-50 font-semibold transition-all duration-200">Refresh Halaman</button>
            </div>
        </div>
    </div>
</x-html>