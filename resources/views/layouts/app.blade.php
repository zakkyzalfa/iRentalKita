<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - iRentalKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-mobile-alt text-lg"></i>
                    <span class="text-xl font-semibold text-gray-800">iRentalKita</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button onclick="goToBeranda()" class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg transition-all duration-300">Beranda</button>
                    <button onclick="goToDaftarIphone()" class="text-gray-900 bg-gray-100 font-medium px-4 py-2 rounded-lg">Daftar iPhone</button>
                </div>
                
                <!-- Header untuk user yang BELUM login -->
                <div id="headerNotLoggedIn" class="flex items-center space-x-4">
                    <button onclick="goToLoginPenyewa()" class="text-gray-700 hover:text-gray-900 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg transition-all duration-300">Login</button>
                    <button onclick="goToRegister()" class="bg-gray-800 text-white px-3 py-2 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300">
                        Daftar
                    </button>
                </div>

                <!-- Header untuk user yang SUDAH login (hidden by default) -->
                <div id="headerLoggedIn" class="flex items-center space-x-4 hidden">
                    <button onclick="goToDashboardPenyewa()" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 font-medium px-4 py-2 rounded-lg transition-all duration-300">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-medium">
                            J
                        </div>
                        <span class="text-sm font-medium">John Doe</span>
                    </button>
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
                    <p class="text-gray-300">Platform rental iPhone terpercaya di Indonesia dengan layanan terbaik dan harga kompetitif.</p>
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
