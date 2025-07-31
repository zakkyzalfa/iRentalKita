@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Welcome Header -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Selamat Datang, John!</h1>
                        <p class="text-blue-100 text-lg">Kelola rental iPhone Anda dengan mudah</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-mobile-alt text-6xl text-blue-200"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Rental History -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Riwayat Sewa iPhone</h2>
                        
                        <!-- Rental Items -->
                        <div class="space-y-6" id="rentalHistory">
                            
                            <!-- Active Rental -->
                            <div class="border border-gray-200 rounded-xl p-6 bg-blue-50">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- iPhone Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-mobile-alt text-2xl text-gray-400"></i>
                                        </div>
                                    </div>

                                    <!-- Rental Details -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">iPhone 15 Pro Max 256GB</h3>
                                                
                                            </div>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">Sedang Aktif</span>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                                <span>20 Jan - 25 Jan 2025</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                                <span>Rp 250.000</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                                <span>5 hari</span>
                                            </div>
                                            
                                        </div>

                                        <!-- Progress Steps -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                                <span>Progress Sewa</span>
                                                <span>Step 2/4</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pembayaran</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-hand-holding-heart text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-blue-600 ml-1">Pengambilan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-gray-300 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-mobile-alt text-gray-500 text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-1">Penggunaan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-gray-300 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-undo text-gray-500 text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-1">Pengembalian</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <button onclick="goToKonfirmasiPengambilan()" class="bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition-all duration-300 flex items-center">
                                            <i class="fas fa-hand-holding-heart mr-2"></i>
                                            Ambil iPhone
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Rental -->
                            <div class="border border-gray-200 rounded-xl p-6 bg-blue-50">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- iPhone Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-mobile-alt text-2xl text-gray-400"></i>
                                        </div>
                                    </div>

                                    <!-- Rental Details -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">iPhone 15 Pro Max 256GB</h3>
                                                
                                            </div>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">Sedang Aktif</span>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                                <span>20 Jan - 25 Jan 2025</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                                <span>Rp 250.000</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                                <span>5 hari</span>
                                            </div>
                                            
                                        </div>

                                        <!-- Progress Steps -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                                <span>Progress Sewa</span>
                                                <span>Step 2/4</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pembayaran</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-500 ml-1">Pengambilan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-1">Penggunaan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-undo text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-1">Pengembalian</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <button onclick="goToKonfirmasiPengembalian()" class="bg-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition-all duration-300 flex items-center">
                                            <i class="fas fa-undo mr-2"></i>
                                            Kembalikan iPhone
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Completed Rental -->
                            <div class="border border-gray-200 rounded-xl p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- iPhone Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-mobile-alt text-2xl text-gray-400"></i>
                                        </div>
                                    </div>

                                    <!-- Rental Details -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">iPhone 14 128GB</h3>
                                                
                                            </div>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">Selesai</span>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                                <span>10 Jan - 15 Jan 2025</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                                <span>Rp 200.000</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                                <span>5 hari</span>
                                            </div>
                                            
                                        </div>

                                        <!-- Completed Progress -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                                <span>Progress Sewa</span>
                                                <span>Selesai</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pembayaran</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pengambilan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Penggunaan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pengembalian</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Completed Badge -->
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                            <div class="flex items-center text-green-800">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                <span class="text-sm font-medium">Sewa selesai tanpa denda</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rental with Penalty -->
                            <div class="border border-gray-200 rounded-xl p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- iPhone Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-mobile-alt text-2xl text-gray-400"></i>
                                        </div>
                                    </div>

                                    <!-- Rental Details -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">iPhone 13 256GB</h3>
                                                
                                            </div>
                                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">Denda Dibayar</span>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                                <span>25 Des - 30 Des 2024</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave mr-2 text-gray-400"></i>
                                                <span>Rp 300.000 + Denda Rp 50.000</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                                <span>5 hari + 2 hari terlambat</span>
                                            </div>
                                            
                                        </div>

                                        <!-- Completed Progress -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                                <span>Progress Sewa</span>
                                                <span>Selesai dengan Denda</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pembayaran</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Pengambilan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-green-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-green-600 ml-1">Penggunaan</span>
                                                </div>
                                                <div class="flex-1 h-1 bg-red-500 rounded"></div>
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-exclamation text-white text-xs"></i>
                                                    </div>
                                                    <span class="text-xs text-red-600 ml-1">Denda</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Penalty Badge -->
                                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                            <div class="flex items-center text-red-800">
                                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                                <span class="text-sm font-medium">Terlambat 2 hari - Denda Rp 50.000 (Sudah dibayar)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State (Hidden by default, show when no rentals) -->
                        <div id="emptyState" class="text-center py-12 hidden">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-mobile-alt text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada iPhone yang Dipesan</h3>
                            <p class="text-gray-600 mb-6">Anda belum memiliki riwayat sewa iPhone. Mulai sewa iPhone pertama Anda sekarang!</p>
                            <button onclick="window.location.href='daftar-iphone.html'" class="bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-300 flex items-center justify-center mx-auto">
                                <i class="fas fa-plus mr-2"></i>
                                Sewa iPhone Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Profile -->
                <div>
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Profile Saya</h2>
                        
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-white">J</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">John Doe</h3>
                            <p class="text-sm text-gray-600">Member sejak Jan 2024</p>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" value="John Doe" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" value="johndoe@email.com" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <input type="tel" value="+62 812-3456-7890" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea rows="3" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>Jl. Merdeka No. 123, RT 01/RW 02, Kelurahan Merdeka, Kecamatan Bandung Wetan, Kota Bandung, Jawa Barat 40111</textarea>
                            </div>
                        </div>

                        <button onclick="editProfile()" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profile
                        </button>

                        <button onclick="logout()" class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center mt-3">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Log Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
    // Extend rental function
    function extendRental() {
            if (confirm('Apakah Anda ingin memperpanjang rental iPhone 15 Pro Max?')) {
                alert('Fitur perpanjang rental akan mengarahkan ke halaman pembayaran tambahan.\n\nBiaya perpanjangan: Rp 50.000/hari');
                // In real implementation:
                // window.location.href = 'perpanjang-rental.html';
            }
        }

        // View history function
        function viewHistory() {
            alert('Mengarahkan ke halaman riwayat rental...\n\nAnda dapat melihat semua rental sebelumnya dan statusnya.');
            // In real implementation:
            // window.location.href = 'riwayat-rental.html';
        }

        // Contact support function
        function contactSupport() {
            alert('Pilih metode kontak:\n\n1. Telepon: +62 812-3456-7890\n2. WhatsApp: +62 812-3456-7890\n3. Email: support@irentalkita.com');
        }

        // Edit profile function
        function editProfile() {
            alert('Mengarahkan ke halaman edit profile...\n\nAnda dapat mengubah informasi personal, password, dan preferensi.');
            // In real implementation:
            // window.location.href = 'edit-profile.html';
        }

        // View all notifications function
        function viewAllNotifications() {
            alert('Mengarahkan ke halaman notifikasi...\n\nAnda dapat melihat semua notifikasi dan mengatur preferensi notifikasi.');
            // In real implementation:
            // window.location.href = 'notifikasi.html';
        }

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil - akan redirect ke halaman login');
                // window.location.href = 'login.html';
            }
        }

        // Update progress bar based on rental duration
        function updateRentalProgress() {
            // This would be calculated based on actual rental start date
            // For demo purposes, showing 0% progress (just started)
            const progressBar = document.querySelector('.bg-blue-600');
            const progressText = document.querySelector('.text-xs.text-gray-600');
            
            // Example: if rental started today, progress would be calculated
            // progressBar.style.width = '20%';
            // progressText.textContent = '1/5 hari';
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            updateRentalProgress();
            
            // Auto-refresh notifications every 30 seconds (in real implementation)
            // setInterval(refreshNotifications, 30000);
            
            console.log('Dashboard penyewa loaded successfully');
        });

        // Refresh notifications (placeholder)
        function refreshNotifications() {
            // In real implementation, this would fetch new notifications from API
            console.log('Refreshing notifications...');
        }
 </script>
@endpush


