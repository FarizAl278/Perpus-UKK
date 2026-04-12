<x-html>

    <body>

        {{-- Navbar --}}
        <x-navbar />

        {{-- Content --}}
        <main class="min-h-screen scroll-smooth">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-footer />

    </body>
    
</x-html>
