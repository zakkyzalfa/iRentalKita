@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-4xl mx-auto px-8 mb-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Proses Pengambilan iPhone</h1>
                <p class="text-lg text-gray-600">Verifikasi dan serahkan iPhone kepada penyewa</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                
                <!-- Customer & Rental Info - 40% (2 columns) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user mr-3 text-gray-600"></i>
                            Data Penyewa & Rental
                        </h2>

                        <!-- Customer Details -->
                        <div class="space-y-4 mb-6">
                            <div class="text-center mb-4">
                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <span class="text-xl font-bold text-white">S</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Sarah Wilson</h3>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-900">sarah.wilson@email.com</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="font-medium text-gray-900">+62 812-3456-7891</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">No. KTP:</span>
                                <span class="font-medium text-gray-900">3201234567890123</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tipe iPhone:</span>
                                <span class="font-medium text-gray-900">iPhone 14 Pro 128GB</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">IMEI:</span>
                                <span class="font-medium text-gray-900">987654321098765</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Mulai:</span>
                                <span class="font-medium text-gray-900">21 Jan 2025</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Kembali:</span>
                                <span class="font-medium text-gray-900">28 Jan 2025</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Durasi:</span>
                                <span class="font-medium text-gray-900">7 hari</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total:</span>
                                <span class="font-medium text-gray-900">Rp 266.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Status Bayar:</span>
                                <span class="font-medium text-green-600">Lunas</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Process Steps - 60% (3 columns) -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        
                        <!-- Step 1: Verifikasi Identitas -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    1
                                </div>
                                Verifikasi Identitas Penyewa
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="ktpCheck" class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                    <label for="ktpCheck" class="text-gray-900 font-medium">KTP Asli sesuai data registrasi</label>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="fotoCheck" class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                    <label for="fotoCheck" class="text-gray-900 font-medium">Foto penyewa sesuai KTP</label>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="buktiCheck" class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                    <label for="buktiCheck" class="text-gray-900 font-medium">Bukti pembayaran valid</label>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Pemeriksaan iPhone -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    2
                                </div>
                                Pemeriksaan iPhone Bersama Penyewa
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="layarCheck" class="w-5 h-5 text-orange-600 rounded focus:ring-orange-500">
                                        <label for="layarCheck" class="text-gray-900 font-medium">Layar tidak retak</label>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="bodyCheck" class="w-5 h-5 text-orange-600 rounded focus:ring-orange-500">
                                        <label for="bodyCheck" class="text-gray-900 font-medium">Body tidak penyok</label>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="bateraiCheck" class="w-5 h-5 text-orange-600 rounded focus:ring-orange-500">
                                        <label for="bateraiCheck" class="text-gray-900 font-medium">Baterai 100%</label>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="chargerCheck" class="w-5 h-5 text-orange-600 rounded focus:ring-orange-500">
                                        <label for="chargerCheck" class="text-gray-900 font-medium">Charger lengkap</label>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="kemasanCheck" class="w-5 h-5 text-orange-600 rounded focus:ring-orange-500">
                                        <label for="kemasanCheck" class="text-gray-900 font-medium">Kemasan lengkap</label>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="fungsiCheck" class="w-5 h-5 text-orange-600 rounded focus:ring-orange-500">
                                        <label for="fungsiCheck" class="text-gray-900 font-medium">Semua fungsi normal</label>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="catatanAwal" class="block text-sm font-medium text-gray-700 mb-2">
                                        Catatan Kondisi Awal (Opsional)
                                    </label>
                                    <textarea 
                                        id="catatanAwal" 
                                        rows="3" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Catat kondisi khusus iPhone jika ada..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Penyerahan & Jaminan -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    3
                                </div>
                                Penyerahan iPhone & Jaminan
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Jaminan KTP
                                    </h4>
                                    <p class="text-sm text-yellow-700">
                                        KTP penyewa akan ditahan sebagai jaminan selama masa sewa. 
                                        KTP akan dikembalikan setelah iPhone dikembalikan dalam kondisi baik.
                                    </p>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="ktpJaminan" class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                                    <label for="ktpJaminan" class="text-gray-900 font-medium">KTP penyewa telah ditahan sebagai jaminan</label>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="iphoneSerah" class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                                    <label for="iphoneSerah" class="text-gray-900 font-medium">iPhone telah diserahkan kepada penyewa</label>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="penjelasan" class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                                    <label for="penjelasan" class="text-gray-900 font-medium">Penjelasan aturan sewa telah diberikan</label>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button onclick="konfirmasiPengambilan()" class="flex-1 bg-green-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-green-700 transition-all duration-300 flex items-center justify-center text-lg" id="konfirmasiBtn" disabled>
                                <i class="fas fa-check mr-3"></i>
                                Konfirmasi Pengambilan
                            </button>
                            
                            <button onclick="batalkanProses()" class="flex-1 bg-red-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center text-lg">
                                <i class="fas fa-times mr-3"></i>
                                Batalkan Proses
                            </button>
                        </div>

                        <!-- Important Notes -->
                        <div class="bg-gray-100 border border-gray-300 rounded-2xl p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-3"></i>
                                Catatan Penting untuk Petugas
                            </h2>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Pastikan semua checklist telah dicentang sebelum konfirmasi</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>KTP penyewa harus disimpan dengan aman di tempat khusus</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Foto kondisi iPhone sebelum diserahkan (opsional tapi direkomendasikan)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Berikan nomor kontak customer service untuk emergency</span>
                                </li>
                            </ul>
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
        // Check if all required checkboxes are checked
        function checkAllRequirements() {
            const requiredChecks = [
                'ktpCheck', 'fotoCheck', 'buktiCheck',
                'layarCheck', 'bodyCheck', 'bateraiCheck', 'chargerCheck', 'kemasanCheck', 'fungsiCheck',
                'ktpJaminan', 'iphoneSerah', 'penjelasan'
            ];
            
            const allChecked = requiredChecks.every(id => document.getElementById(id).checked);
            const konfirmasiBtn = document.getElementById('konfirmasiBtn');
            
            if (allChecked) {
                konfirmasiBtn.disabled = false;
                konfirmasiBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                konfirmasiBtn.disabled = true;
                konfirmasiBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Konfirmasi pengambilan
        function konfirmasiPengambilan() {
            const catatan = document.getElementById('catatanAwal').value;
            
            if (confirm('Apakah Anda yakin semua proses pengambilan telah selesai dengan benar?')) {
                // Show loading state
                const btn = document.getElementById('konfirmasiBtn');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Memproses...';
                btn.disabled = true;
                
                setTimeout(() => {
                    alert(`Pengambilan iPhone berhasil dikonfirmasi!\n\nPenyewa: Sarah Wilson\niPhone: iPhone 14 Pro 128GB\nIMEI: 987654321098765\nTanggal Ambil: ${new Date().toLocaleDateString('id-ID')}\n\nKTP telah ditahan sebagai jaminan.\nStatus rental: AKTIF`);
                    
                    // In real implementation:
                    // - Update database status
                    // - Send notification to customer
                    // - Generate pickup receipt
                    
                    window.location.href = 'dashboard-admin.html';
                }, 1500);
            }
        }

        // Batalkan proses
        function batalkanProses() {
            if (confirm('Apakah Anda yakin ingin membatalkan proses pengambilan ini?')) {
                alert('Proses pengambilan dibatalkan.\nStatus rental dikembalikan ke "Menunggu Pengambilan".');
                window.location.href = 'dashboard-admin.html';
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to all checkboxes
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', checkAllRequirements);
            });
            
            // Initial check
            checkAllRequirements();
            
            console.log('Proses pengambilan page loaded');
        });
 </script>
@endpush


