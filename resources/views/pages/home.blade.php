<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 px-20 bg-white text-center">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Content Left -->
                <div class="space-y-6">
                    <div class="space-y-6">
                        <h1 class="text-6xl text-black font-bold">iRentalKita</h1>
                        <p class="text-5xl lg:text-lg font-medium text-gray-900 leading-tight">Nikmati iPhone terbaru tanpa perlu beli. Sewa iPhone berkualitas dengan harga terjangkau, proses mudah dan
                            <span class="text-gray-600">layanan terpercaya.</span>
                        </p>
                    </div>
                    
                    <!-- Features -->
                    
                    
                    <button onclick="scrollToIphoneSection()" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300 flex items-center justify-center space-x-2 mx-auto">
                        <span>Mulai Sewa Sekarang</span>
                        <i class="fas fa-arrow-down text-sm"></i>
                    </button>
                </div>
                
                <!-- Image Right -->
                <div class="flex justify-center lg:justify-end rounded-2xl">
                    <div class="relative max-w-2xl w-full">
                        <img src="assets/images/hero-section-background.jpeg" alt="iPhone Features" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- iPhone Catalog -->
    <section id="iphone-section" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-16 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Daftar iPhone Tersedia</h2>
                    <p class="text-xl text-gray-600">
                        Pilih iPhone impian Anda dari koleksi terlengkap kami. Semua device dalam kondisi prima dan 
                        siap pakai.
                    </p>
                </div>
                <button onclick="goToDaftarIphone()" class="bg-gray-800 text-white px-5 py-2 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500 whitespace-nowrap">
                    Daftar iPhone
                </button>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- iPhone 15 Pro Max -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500">
                    <div class="relative">
                        <div class="p-6">
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                                <img src="assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro Max" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">iPhone 15 Pro Max</h3>
                        <p class="text-gray-600 mb-4">256GB • Natural Titanium</p>
                        <div class="mb-6">
                            <span class="text-2xl font-bold text-gray-900">Rp 50.000</span>
                            <span class="text-gray-500 text-lg">/hari</span>
                        </div>
                        <button onclick="rentIphone('iPhone 15 Pro Max')" class="w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500">
                            Sewa Sekarang
                        </button>
                    </div>
                </div>

                <!-- iPhone 15 Pro -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500">
                    <div class="relative">
                        <div class="p-6">
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                                <img src="assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">iPhone 15 Pro</h3>
                        <p class="text-gray-600 mb-4">128GB • Blue Titanium</p>
                        <div class="mb-6">
                            <span class="text-2xl font-bold text-gray-900">Rp 45.000</span>
                            <span class="text-gray-500 text-lg">/hari</span>
                        </div>
                        <button onclick="rentIphone('iPhone 15 Pro')" class="w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500">
                            Sewa Sekarang
                        </button>
                    </div>
                </div>

                <!-- iPhone 15 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500">
                    <div class="relative">
                        <div class="p-6">
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                                <img src="assets/images/iphone-16-pro.webp" alt="iPhone 15" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">iPhone 15</h3>
                        <p class="text-gray-600 mb-4">128GB • Pink</p>
                        <div class="mb-6">
                            <span class="text-2xl font-bold text-gray-900">Rp 35.000</span>
                            <span class="text-gray-500 text-lg">/hari</span>
                        </div>
                        <button onclick="rentIphone('iPhone 15')" class="w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500">
                            Sewa Sekarang
                        </button>
                    </div>
                </div>

                <!-- iPhone 14 Pro Max -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500 opacity-75">
                    <div class="relative">
                        <div class="p-6">
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                                <img src="assets/images/iphone-16-pro.webp" alt="iPhone 14 Pro Max" class="w-full h-full object-cover grayscale">
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 bg-gray-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tidak Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">iPhone 14 Pro Max</h3>
                        <p class="text-gray-600 mb-4">256GB • Space Black</p>
                        <div class="mb-6">
                            <span class="text-2xl font-bold text-gray-900">Rp 42.000</span>
                            <span class="text-gray-500 text-lg">/hari</span>
                        </div>
                        <button class="w-full bg-gray-400 text-white py-2 rounded-full font-semibold cursor-not-allowed" disabled>
                            Tidak Tersedia
                        </button>
                    </div>
                </div>

                <!-- iPhone 14 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500">
                    <div class="relative">
                        <div class="p-6">
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                                <img src="assets/images/iphone-16-pro.webp" alt="iPhone 14" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">iPhone 14</h3>
                        <p class="text-gray-600 mb-4">128GB • Blue</p>
                        <div class="mb-6">
                            <span class="text-2xl font-bold text-gray-900">Rp 30.000</span>
                            <span class="text-gray-500 text-lg">/hari</span>
                        </div>
                        <button onclick="rentIphone('iPhone 14')" class="w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500">
                            Sewa Sekarang
                        </button>
                    </div>
                </div>

                <!-- iPhone 13 -->
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500">
                    <div class="relative">
                        <div class="p-6">
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                                <img src="assets/images/iphone-16-pro.webp" alt="iPhone 13" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">iPhone 13</h3>
                        <p class="text-gray-600 mb-4">128GB • Midnight</p>
                        <div class="mb-6">
                            <span class="text-2xl font-bold text-gray-900">Rp 25.000</span>
                            <span class="text-gray-500 text-lg">/hari</span>
                        </div>
                        <button onclick="rentIphone('iPhone 13')" class="w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500">
                            Sewa Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Cara Menyewa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Sewa iPhone dalam 4 langkah mudah dan cepat
                </p>
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 text-blue-600">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pilih iPhone</h3>
                    <p class="text-gray-600">Browse dan pilih iPhone yang ingin Anda sewa dari katalog kami</p>
                </div>
            
                <div class="text-center">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 text-green-600">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pesan & Bayar</h3>
                    <p class="text-gray-600">Lakukan pemesanan dan pembayaran secara online dengan aman</p>
                </div>
            
                <div class="text-center">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 text-purple-600">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Ambil iPhone</h3>
                    <p class="text-gray-600">Ambil iPhone di lokasi yang telah ditentukan atau delivery</p>
                </div>
            
                <div class="text-center">
                    <div class="bg-orange-100 w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 text-orange-600">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Nikmati & Kembalikan</h3>
                    <p class="text-gray-600">Gunakan iPhone dan kembalikan sesuai dengan jadwal yang disepakati</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mengapa Pilih iRentalKita?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Keunggulan layanan rental iPhone yang membuat kami berbeda
                </p>
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-2xl shadow-sm">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Semua iPhone telah diverifikasi, diasuransikan, dan dalam kondisi prima</p>
                </div>
            
                <div class="text-center p-8 bg-white rounded-2xl shadow-sm">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Proses Mudah</h3>
                    <p class="text-gray-600">Pemesanan online yang mudah dengan proses persetujuan dalam hitungan menit</p>
                </div>
            
                <div class="text-center p-8 bg-white rounded-2xl shadow-sm">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-money-bill-wave text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600">Nikmati iPhone premium dengan harga rental yang sangat kompetitif</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Toggle Button (untuk testing) -->
    <div class="fixed bottom-4 right-4 z-50">
        <button onclick="toggleLoginState()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition-all duration-300">
            <i class="fas fa-user-circle mr-2"></i>
            Toggle Login State
        </button>
    </div>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
    // tombol hero section
    function scrollToIphoneSection() {
    const iphoneSection = document.getElementById('iphone-section');
    iphoneSection.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}
 </script>
@endpush


