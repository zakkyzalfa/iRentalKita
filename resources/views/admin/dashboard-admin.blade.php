@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Welcome Header -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Dashboard Admin</h1>
                        <p class="text-red-100 text-lg">Kelola sistem rental iPhone dengan mudah</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-cogs text-6xl text-red-200"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total iPhone -->
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total iPhone</p>
                            <p class="text-3xl font-bold text-gray-900">24</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- iPhone Tersedia -->
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">iPhone Tersedia</p>
                            <p class="text-3xl font-bold text-green-600">18</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- iPhone Disewa -->
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">iPhone Disewa</p>
                            <p class="text-3xl font-bold text-orange-600">6</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Penyewa -->
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Penyewa</p>
                            <p class="text-3xl font-bold text-purple-600">156</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Rental Aktif -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Rental Aktif</h2>
                            <button onclick="goToSemuaRental()" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                Lihat Semua
                            </button>
                        </div>
                        
                        <!-- Rental Items -->
                        <div class="space-y-4" id="activeRentals">
                            
                            <!-- Rental Item 1 -->
                            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-medium">
                                            J
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">John Doe</h3>
                                            <p class="text-sm text-gray-600">iPhone 15 Pro Max 256GB</p>
                                        </div>
                                    </div>
                                    <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-1 rounded-full">Sedang Disewa</span>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                                    <div>
                                        <span class="font-medium">Mulai:</span> 20 Jan 2025
                                    </div>
                                    <div>
                                        <span class="font-medium">Kembali:</span> 25 Jan 2025
                                    </div>
                                    <div>
                                        <span class="font-medium">Total:</span> Rp 250.000
                                    </div>
                                    <div>
                                        <span class="font-medium">Status:</span> Aktif
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    <button onclick="lihatDetailRental('R001')" class="flex-1 bg-gray-100 text-gray-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button onclick="prosesKembali('R001')" class="flex-1 bg-blue-600 text-white py-2 px-3 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                        Proses Kembali
                                    </button>
                                </div>
                            </div>

                            <!-- Rental Item 2 -->
                            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white font-medium">
                                            S
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">Sarah Wilson</h3>
                                            <p class="text-sm text-gray-600">iPhone 14 Pro 128GB</p>
                                        </div>
                                    </div>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-full">Menunggu Ambil</span>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                                    <div>
                                        <span class="font-medium">Mulai:</span> 21 Jan 2025
                                    </div>
                                    <div>
                                        <span class="font-medium">Kembali:</span> 28 Jan 2025
                                    </div>
                                    <div>
                                        <span class="font-medium">Total:</span> Rp 266.000
                                    </div>
                                    <div>
                                        <span class="font-medium">Status:</span> Lunas
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    <button onclick="lihatDetailRental('R002')" class="flex-1 bg-gray-100 text-gray-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button onclick="prosesAmbil('R002')" class="flex-1 bg-green-600 text-white py-2 px-3 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                        Proses Ambil
                                    </button>
                                </div>
                            </div>

                            <!-- Rental Item 3 -->
                            <div class="border border-red-200 rounded-xl p-4 bg-red-50">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-medium">
                                            M
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">Mike Johnson</h3>
                                            <p class="text-sm text-gray-600">iPhone 13 128GB</p>
                                        </div>
                                    </div>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">Terlambat</span>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                                    <div>
                                        <span class="font-medium">Mulai:</span> 15 Jan 2025
                                    </div>
                                    <div>
                                        <span class="font-medium">Kembali:</span> 19 Jan 2025
                                    </div>
                                    <div>
                                        <span class="font-medium">Total:</span> Rp 125.000
                                    </div>
                                    <div>
                                        <span class="font-medium text-red-600">Denda:</span> Rp 50.000
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    <button onclick="lihatDetailRental('R003')" class="flex-1 bg-gray-100 text-gray-700 py-2 px-3 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button onclick="hubungiPenyewa('R003')" class="flex-1 bg-red-600 text-white py-2 px-3 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                                        Hubungi Penyewa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Quick Actions & Stats -->
                <div>
                    <div class="space-y-6">
                        
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
                            
                            <div class="space-y-3">                     
                                <button onclick="goToLaporan()" class="w-full bg-purple-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-purple-700 transition-colors flex items-center justify-center">
                                    <i class="fas fa-chart-bar mr-3"></i>
                                    Lihat Laporan
                                </button>
                                <button onclick="logout()" class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Log Out
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Rental management functions
        function lihatDetailRental(rentalId) {
            alert(`Mengarahkan ke detail rental ${rentalId}...`);
            window.location.href = `detail-rental.html?id=${rentalId}`;
        }

        function prosesAmbil(rentalId) {
            if (confirm(`Apakah Anda yakin ingin memproses pengambilan untuk rental ${rentalId}?`)) {
                alert(`Memproses pengambilan rental ${rentalId}...`);
                window.location.href = `proses-pengambilan.html?id=${rentalId}`;
            }
        }

        function prosesKembali(rentalId) {
            if (confirm(`Apakah Anda yakin ingin memproses pengembalian untuk rental ${rentalId}?`)) {
                alert(`Memproses pengembalian rental ${rentalId}...`);
                window.location.href = `proses-pengembalian.html?id=${rentalId}`;
            }
        }

        function hubungiPenyewa(rentalId) {
            alert(`Menghubungi penyewa untuk rental ${rentalId}...\n\nOpsi kontak:\n- Telepon: +62 812-3456-7890\n- WhatsApp: +62 812-3456-7890\n- Email: customer@email.com`);
        }

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil - akan redirect ke halaman login admin');
                window.location.href = '/login-admin';
            }
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard admin loaded successfully');
            
            // Auto-refresh stats every 30 seconds (in real implementation)
            // setInterval(refreshStats, 30000);
        });

        // Refresh stats (placeholder)
        function refreshStats() {
            console.log('Refreshing dashboard stats...');
        }
 </script>
@endpush


