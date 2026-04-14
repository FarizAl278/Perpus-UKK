<x-html>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap');
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        @keyframes drift { from{transform:translateX(-350px)} to{transform:translateX(calc(100vw+350px))} }
        .cloud-1{animation:drift 60s linear infinite} .cloud-2{animation:drift 80s linear -20s infinite} .cloud-3{animation:drift 100s linear -40s infinite}
        .float-anim{animation:float 6s ease-in-out infinite}
        body{font-family:'Sora',sans-serif} .font-serif-display{font-family:'DM Serif Display',serif}
    </style>

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="sky404" cx="50%" cy="30%" r="70%"><stop offset="0%" stop-color="#e0f7ff"/><stop offset="100%" stop-color="#f7fbff"/></radialGradient></defs>
            <rect width="1440" height="900" fill="url(#sky404)"/>
            <g class="cloud-1" style="opacity:0.55"><ellipse cx="180" cy="60" rx="110" ry="42" fill="white"/><ellipse cx="230" cy="45" rx="75" ry="38" fill="white"/><ellipse cx="130" cy="55" rx="65" ry="32" fill="white"/><ellipse cx="280" cy="60" rx="55" ry="28" fill="white"/></g>
            <g class="cloud-2" style="opacity:0.5;transform:translateY(150px)"><ellipse cx="200" cy="55" rx="130" ry="38" fill="white"/><ellipse cx="260" cy="38" rx="90" ry="35" fill="white"/><ellipse cx="150" cy="50" rx="70" ry="30" fill="white"/><ellipse cx="310" cy="55" rx="60" ry="26" fill="white"/></g>
            <g class="cloud-3" style="opacity:0.4;transform:translateY(320px)"><ellipse cx="160" cy="50" rx="95" ry="35" fill="#e8f5ff"/><ellipse cx="210" cy="38" rx="70" ry="32" fill="#e8f5ff"/><ellipse cx="115" cy="48" rx="60" ry="26" fill="#e8f5ff"/><ellipse cx="250" cy="52" rx="48" ry="22" fill="#e8f5ff"/></g>
        </svg>
    </div>

    <div x-data="{ mx: 0, my: 0 }" @mousemove.window="mx = ($event.clientX / window.innerWidth - 0.5) * 20; my = ($event.clientY / window.innerHeight - 0.5) * 20" class="relative z-10 min-h-screen flex items-center justify-center px-6 py-20">
        <div class="text-center max-w-md">
            <div class="float-anim mb-6 relative inline-block">
                <span class="text-9xl font-serif-display text-sky-300/30 absolute -top-8 left-1/2 -translate-x-1/2 select-none">404</span>
                <div class="w-32 h-32 mx-auto bg-gradient-to-br from-sky-400 to-blue-500 rounded-3xl flex items-center justify-center shadow-xl shadow-sky-200/50 transform transition-transform duration-200" :style="`transform: translate(${mx}px, ${my}px) scale(1)`">
                    <i class="bi bi-compass text-5xl text-white"></i>
                </div>
            </div>
            <h1 class="font-serif-display text-3xl text-slate-900 mb-3">Halaman Tidak Ditemukan</h1>
            <p class="text-slate-500 mb-8 leading-relaxed">Sepertinya kamu tersesat di antara awan. Halaman yang kamu cari mungkin sudah dipindahkan atau tidak pernah ada.</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="/" class="px-6 py-3 rounded-full bg-sky-500 hover:bg-sky-600 text-white font-semibold transition-all duration-200 shadow-md shadow-sky-200/50 hover:-translate-y-0.5">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</x-html>