<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - iRentalKita</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

    <!-- Header/Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-mobile-alt text-lg"></i>
                    <span class="text-xl font-semibold text-gray-800">iRentalKita</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}"
                    class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg transition-all duration-300
                    {{ Route::is('home') ? 'bg-gray-100 text-gray-900' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('daftar-iphone') }}"
                    class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg transition-all duration-300
                    {{ Route::is('daftar-iphone') ? 'bg-gray-100 text-gray-900' : '' }}">
                        Daftar iPhone
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @if(Auth::guard('penyewa')->check())
                        @php
                            $nama = Auth::guard('penyewa')->user()->nama;
                            $initial = strtoupper(substr($nama, 0, 1));
                        @endphp
                        <a href="{{ route('dashboard-penyewa') }}"
                        class="flex items-center space-x-2 px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ Route::is('dashboard-penyewa') ? 'bg-gray-100 text-gray-900 border-2 border-blue-500' : 'bg-gray-800 text-white border-2 border-gray-800 hover:bg-gray-100 hover:border-blue-500 hover:text-gray-800' }}">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                {{ $initial }}
                            </div>
                            <span>{{ strlen($nama) > 18 ? substr($nama, 0, 15) . '...' : $nama }}</span>
                        </a>
                    @else
                        <a href="{{ route('login-penyewa') }}"
                        class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg transition-all duration-300 {{ Route::is('login-penyewa') ? 'bg-gray-100 text-gray-900' : '' }}">
                            Login
                        </a>
                        <a href="{{ route('pendaftaran') }}"
                        class="font-medium px-3 py-2 rounded-lg border-2 border-gray-800 transition-all duration-300
                        {{ Route::is('pendaftaran') ? 'bg-gray-100 text-gray-900 border-gray-900' : 'bg-gray-800 text-white hover:bg-transparent hover:border-gray-800 hover:text-gray-800' }}">
                            Daftar
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <!-- Konten Halaman -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-mobile-alt text-2xl text-white"></i>
                        <span class="text-2xl font-bold">iRentalKita</span>
                    </div>
                    <p class="text-gray-300">Rental iPhone terpercaya dengan layanan terbaik dan proses yang mudah.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</p>
                        <p><i class="fas fa-envelope mr-2"></i> irentalkita@gmail.com</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Bandung, Indonesia</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-600 mt-8 pt-6 text-center">
                <p class="text-gray-300">&copy; 2025 iRentalKita. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Script global --}}
    <script src="{{ asset('js/global.js') }}"></script>
    {{-- Script khusus halaman --}}
    @stack('scripts')
</body>
</html>