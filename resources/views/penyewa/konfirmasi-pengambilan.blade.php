@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-4xl mx-auto px-8 mb-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Konfirmasi Pengambilan iPhone</h1>
                <p class="text-lg text-gray-600">Siap untuk mengambil iPhone Anda? Ikuti panduan di bawah ini</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                
                <!-- Ringkasan Pesanan - 40% (2 columns) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-receipt mr-3 text-gray-600"></i>
                            Rincian Pemesanan
                        </h2>

                        <!-- Customer & Rental Details -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nama Lengkap:</span>
                                <span class="font-medium text-gray-900" id="customerName">John Doe</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tipe iPhone:</span>
                                <span class="font-medium text-gray-900" id="phoneType">iPhone 15 Pro Max 256GB</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">IMEI:</span>
                                <span class="font-medium text-gray-900" id="summaryDuration">123456789012345</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Biaya Sewa Per Hari:</span>
                                <span class="font-medium text-gray-900" id="pricePerDay">Rp 50.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Mulai:</span>
                                <span class="font-medium text-gray-900" id="summaryStartDate">20 Jan 2025</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Kembali:</span>
                                <span class="font-medium text-gray-900" id="summaryEndDate">25 Jan 2025</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Durasi Sewa:</span>
                                <span class="font-medium text-gray-900" id="summaryDuration">5 hari</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Pembayaran:</span>
                                <span class="font-medium text-gray-900" id="summaryDuration">Rp 250.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Status Pembayaran:</span>
                                <span class="font-medium text-gray-900" id="summaryDuration">Berhasil</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Pickup Information -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        
                        <!-- Requirements -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-clipboard-check mr-3 text-gray-600"></i>
                                Persyaratan Pengambilan
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-4 mt-0.5">
                                        1
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">KTP Asli</h3>
                                        <p class="text-sm text-gray-600">Bawa KTP asli sesuai data yang terdaftar</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-4 mt-0.5">
                                        2
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Bukti Pembayaran</h3>
                                        <p class="text-sm text-gray-600">Screenshot atau print bukti pembayaran</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-4 mt-0.5">
                                        3
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Uang Tunai (Jika Bayar di Tempat)</h3>
                                        <p class="text-sm text-gray-600">Siapkan uang Tunai</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pickup Process -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-list-ol mr-3 text-gray-600"></i>
                                Proses Pengambilan
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">
                                        1
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Datang ke Toko iRentalKita</h3>
                                        <p class="text-sm text-gray-600">Kunjungi Toko iRentalKita sesuai pada tanggal anda memulai sewa</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">
                                        2
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Menyerahkan Jaminan Anda</h3>
                                        <p class="text-sm text-gray-600">Serahkan KTP anda sebagai jaminan penyewaan</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">
                                        3
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Pengecekan iPhone</h3>
                                        <p class="text-sm text-gray-600">Cek kondisi iPhone bersama Petugas sebelum dibawa</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">
                                        4
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Pembayaran (Jika Belum)</h3>
                                        <p class="text-sm text-gray-600">Lakukan pembayaran jika anda memilih bayar di tempat</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-4 mt-0.5">
                                        5
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">iPhone Siap Dibawa</h3>
                                        <p class="text-sm text-gray-600">Terima iPhone dan nikmati!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Important Notes -->
                        <div class="bg-gray-100 border border-gray-300 rounded-2xl p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-3"></i>
                                Catatan Penting
                            </h2>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Anda wajib melakukan Konfirmasi dibawah jika anda telah menerima iPhone dan menyerahkan Jaminan KTP</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>iPhone harus dikembalikan dalam kondisi baik sesuai tanggal yang sudah disepakati</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Jika terlambat mengembalikan, akan dikenakan denda Rp 100.000/hari</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Kerusakan atau kehilangan menjadi tanggung jawab penyewa (jika hilang, anda wajib menggantinya dengan yang baru)</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button onclick="konfirmasiPengambilan()" class="flex-1 bg-green-600 text-white px-4 py-6 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-green-600 hover:text-green-600 border-2 border-green-600 transition-all duration-300 flex items-center justify-center text-lg">
                                <i class="fas fa-check mr-3"></i>
                                Konfirmasi Pengambilan
                            </button>
                            <button onclick="goToDashboardPenyewa()" class="flex-1 bg-gray-800 text-white px-4 py-6 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300 flex flex items-center justify-center text-lg">
                                <i class="fas fa-calendar-alt mr-3"></i>
                                Buka Dashboard
                            </button>
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
    // Confirm pickup
    function konfirmasiPengambilan() {
            if (confirm('Apakah Anda yakin siap untuk mengambil iPhone hari ini?')) {
                alert('Konfirmasi berhasil!\n\nSilakan datang ke store dengan membawa:\n- KTP Asli\n- Bukti Pembayaran\n- Kode Pengambilan: IRK-2025-001\n\nTerima kasih!');
                // In real implementation:
                // Send confirmation to backend
                // Update order status
                window.location.href = 'dashboard-penyewa.html';
            }
        }

        // Reschedule pickup
        function reschedulePickup() {
            alert('Fitur reschedule akan mengarahkan ke form pemilihan tanggal baru.\n\nAnda dapat mengubah jadwal pengambilan maksimal 1x tanpa biaya tambahan.');
            // In real implementation:
            // window.location.href = 'reschedule-pickup.html';
        }

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil - akan redirect ke halaman login');
                // window.location.href = 'login.html';
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add any initialization code here
            console.log('Konfirmasi pengambilan page loaded');
        });
 </script>
@endpush


