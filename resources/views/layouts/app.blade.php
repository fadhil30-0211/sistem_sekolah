<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Portal Resmi - SMA Negeri Okura' }}</title>
    <!-- Tailwind CSS & Flowbite CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#0B192C',
                        emerald: '#1E5128',
                        gold: '#D4AF37',
                        offwhite: '#F8F9FA'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-offwhite text-navy font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-navy border-b border-slate-800 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo Sekolah -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="bg-gold text-navy font-black px-2 py-1 rounded text-xs">SMAN</span>
                        <span class="font-bold text-lg tracking-wide text-white">OKURA</span>
                    </a>
                </div>

                <!-- Menu Navigasi Utama -->
                <div class="hidden md:flex items-center space-x-6 text-xs font-medium">
                    <a href="{{ route('home') }}" class="hover:text-gold transition {{ request()->routeIs('home') ? 'text-gold font-bold' : 'text-gray-300' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profil') }}" class="hover:text-gold transition {{ request()->routeIs('profil') ? 'text-gold font-bold' : 'text-gray-300' }}">
                        Profil Sekolah
                    </a>
                    <a href="{{ route('berita.index') }}" class="hover:text-gold transition {{ request()->routeIs('berita.*') ? 'text-gold font-bold' : 'text-gray-300' }}">
                        Berita
                    </a>
                    <a href="{{ route('lms.index') }}" class="hover:text-gold transition {{ request()->routeIs('lms.*') ? 'text-gold font-bold' : 'text-gray-300' }}">
                        LMS Light
                    </a>
                    <a href="{{ route('services.check') }}" class="hover:text-gold transition {{ request()->routeIs('services.check') ? 'text-gold font-bold' : 'text-gray-300' }}">
                        Lacak Resi
                    </a>
                    <a href="{{ route('galeri') }}" class="hover:text-gold transition {{ request()->routeIs('galeri') ? 'text-gold font-bold' : 'text-gray-300' }}">
                        Galeri
                    </a>
                </div>

                <!-- Autentikasi & Tombol Masuk/Keluar -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="hidden sm:inline-block bg-emerald hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shadow-md">
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg text-white transition font-semibold shadow-md">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-xs bg-gold text-navy font-bold px-4 py-2 rounded-lg hover:bg-yellow-500 transition shadow-md">Masuk</a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Footer dengan Credit KKN -->
    <footer class="bg-navy text-gray-300 py-6 border-t border-emerald/20 text-center text-sm">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; {{ date('Y') }} SMA Negeri Okura. Hak Cipta Dilindungi.</p>
            <p class="text-gold mt-1 text-xs">Dikembangkan ulang dari Proyek KKN Kelompok 10 GOKURA USTI 2026</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>
