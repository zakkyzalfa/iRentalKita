@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-4xl mx-auto px-8 mb-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-undo text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Konfirmasi Pengembalian iPhone</h1>
                <p class="text-lg text-gray-600">Status pemeriksaan dan pengembalian iPhone Anda</p>
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

                        <!-- Inspection Status -->
                        <div id="inspectionStatus" class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-search text-yellow-600 mr-2"></i>
                                <span class="font-semibold text-yellow-800">Sedang Diperiksa</span>
                            </div>
                            <p class="text-sm text-yellow-700 mt-1">Petugas sedang memeriksa kondisi iPhone</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Return Information -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        
                        <!-- Inspection Results -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-clipboard-list mr-3 text-gray-600"></i>
                                Hasil Pemeriksaan Petugas
                            </h2>
                            
                            <!-- Waiting for Inspection -->
                            <div id="waitingInspection" class="text-center py-8">
                                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-hourglass-half text-yellow-600 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Menunggu Pemeriksaan</h3>
                                <p class="text-gray-600">Petugas sedang memeriksa kondisi iPhone dan aksesoris Anda</p>
                            </div>

                            <!-- Inspection Results (Hidden by default) -->
                            <div id="inspectionResults" class="hidden">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-mobile-alt mr-3 text-green-600"></i>
                                            <span class="font-medium text-gray-900">Layar</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600">Baik</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-hand-paper mr-3 text-green-600"></i>
                                            <span class="font-medium text-gray-900">Body</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600">Baik</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-plug mr-3 text-red-600"></i>
                                            <span class="font-medium text-gray-900">Charger</span>
                                        </div>
                                        <span class="text-sm font-medium text-red-600">Hilang</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-box mr-3 text-green-600"></i>
                                            <span class="font-medium text-gray-900">Kemasan</span>
                                        </div>
                                        <span class="text-sm font-medium text-green-600">Baik</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penalty Details (Hidden by default) -->
                        <div id="penaltyDetails" class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 hidden">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-3 text-red-600"></i>
                                Detail Denda
                            </h2>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-center p-4 bg-red-50 rounded-lg">
                                    <div>
                                        <h3 class="font-semibold text-red-800">Charger Hilang</h3>
                                        <p class="text-sm text-red-600">Biaya penggantian charger original</p>
                                    </div>
                                    <span class="text-lg font-bold text-red-600">Rp 150.000</span>
                                </div>
                                
                                <div class="flex justify-between items-center p-4 bg-yellow-50 rounded-lg">
                                    <div>
                                        <h3 class="font-semibold text-yellow-800">Keterlambatan</h3>
                                        <p class="text-sm text-yellow-600">1 hari × Rp 25.000</p>
                                    </div>
                                    <span class="text-lg font-bold text-yellow-600">Rp 25.000</span>
                                </div>
                            </div>

                            <!-- Total Penalty -->
                            <div class="bg-red-100 border border-red-300 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-red-800">Total Denda:</span>
                                    <span class="text-2xl font-bold text-red-800" id="totalPenalty">Rp 175.000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods (Hidden by default) -->
                        <div id="paymentMethods" class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 hidden">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-credit-card mr-3 text-gray-600"></i>
                                Pilih Metode Pembayaran Denda
                            </h2>
                            
                            <div class="space-y-4">
                                <!-- Cash Payment Option -->
                                <div class="payment-method border-2 border-gray-300 rounded-xl p-4 cursor-pointer hover:border-gray-800 transition-all duration-300" data-method="cash">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="radio" id="cash" name="paymentMethod" value="cash" class="mr-3 text-gray-800 focus:ring-gray-800">
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Bayar Tunai</h4>
                                                <p class="text-xs text-gray-600">Bayar langsung di tempat</p>
                                            </div>
                                        </div>
                                        <i class="fas fa-money-bill-wave text-2xl text-gray-600"></i>
                                    </div>
                                </div>

                                <!-- Bank Transfer Option -->
                                <div class="payment-method border-2 border-gray-300 rounded-xl p-4 cursor-pointer hover:border-gray-800 transition-all duration-300" data-method="transfer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="radio" id="transfer" name="paymentMethod" value="transfer" class="mr-3 text-gray-800 focus:ring-gray-800">
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Transfer Bank</h4>
                                                <p class="text-xs text-gray-600">BCA, BNI, BRI, Mandiri</p>
                                            </div>
                                        </div>
                                        <i class="fas fa-university text-2xl text-gray-600"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Details (Hidden by default) -->
                            <div id="paymentDetails" class="mt-6">
                                <!-- Cash Details -->
                                <div id="cashDetails" class="bg-green-50 border border-green-200 rounded-lg p-4 hidden">
                                    <h4 class="font-semibold text-green-800 mb-3 flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Pembayaran Tunai
                                    </h4>
                                    <div class="space-y-2 text-sm text-green-700">
                                        <p>• Bayar langsung di tempat saat pengembalian iPhone</p>
                                        <p>• Siapkan uang pas sebesar Rp 175.000</p>
                                        <p>• KTP akan dikembalikan setelah pembayaran</p>
                                    </div>
                                </div>

                                <!-- Transfer Details -->
                                <div id="transferDetails" class="bg-blue-50 border border-blue-200 rounded-lg p-4 hidden">
                                    <h4 class="font-semibold text-blue-800 mb-3 flex items-center">
                                        <i class="fas fa-university mr-2"></i>
                                        Detail Transfer Bank
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-blue-700">Bank:</span>
                                            <span class="font-medium ml-2 text-blue-900">BCA</span>
                                        </div>
                                        <div>
                                            <span class="text-blue-700">No. Rekening:</span>
                                            <span class="font-medium ml-2 text-blue-900">1234567890</span>
                                        </div>
                                        <div>
                                            <span class="text-blue-700">Atas Nama:</span>
                                            <span class="font-medium ml-2 text-blue-900">iRentalKita</span>
                                        </div>
                                        <div>
                                            <span class="text-blue-700">Jumlah:</span>
                                            <span class="font-medium ml-2 text-blue-900">Rp 175.000</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div id="paymentStatus" class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 hidden">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-credit-card mr-3 text-gray-600"></i>
                                Status Pembayaran Denda
                            </h2>
                            
                            <div id="unpaidStatus" class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold text-red-800">Belum Dibayar</h3>
                                        <p class="text-sm text-red-600">Denda belum dibayar</p>
                                    </div>
                                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                                </div>
                                <div class="border-t border-red-300 pt-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-id-card text-red-600 mr-2"></i>
                                        <span class="text-sm font-medium text-red-800">KTP Ditahan sebagai Jaminan</span>
                                    </div>
                                </div>
                            </div>

                            <div id="paidStatus" class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 hidden">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold text-green-800">Sudah Dibayar</h3>
                                        <p class="text-sm text-green-600">Pembayaran denda berhasil dikonfirmasi</p>
                                    </div>
                                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                                </div>
                                <div class="border-t border-green-300 pt-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-id-card text-green-600 mr-2"></i>
                                        <span class="text-sm font-medium text-green-800">KTP Siap Dikembalikan</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <!-- Pay Penalty Button (Hidden by default) -->
                            <button id="payPenaltyBtn" onclick="payPenalty()" class="flex-1 bg-red-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center text-lg hidden">
                                <i class="fas fa-credit-card mr-3"></i>
                                Bayar Denda - Rp 175.000
                            </button>
                            
                            <!-- Confirm Return Button (Disabled by default) -->
                            <button id="confirmReturnBtn" onclick="konfirmasiPengembalian()" class="flex-1 bg-green-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-green-700 transition-all duration-300 flex items-center justify-center text-lg opacity-50 cursor-not-allowed" disabled>
                                <i class="fas fa-check mr-3"></i>
                                Konfirmasi Pengembalian
                            </button>
                        </div>

                        <!-- Important Notes -->
                        <div class="bg-gray-100 border border-gray-300 rounded-2xl p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-3"></i>
                                Informasi Penting
                            </h2>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Petugas akan memeriksa kondisi iPhone dan menentukan denda (jika ada)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>KTP akan ditahan sebagai jaminan jika ada denda yang belum dibayar</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Setelah denda dibayar, Anda dapat mengkonfirmasi pengembalian</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>KTP akan dikembalikan setelah konfirmasi pengembalian selesai</span>
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
    // Simulate inspection process
    let inspectionComplete = false;
        let hasPenalty = false;
        let penaltyPaid = false;
        let selectedPaymentMethod = null;

        // Payment method selection
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethods = document.querySelectorAll('.payment-method');
            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    // Remove active state from all methods
                    paymentMethods.forEach(m => {
                        m.classList.remove('border-gray-800', 'bg-gray-50');
                        m.classList.add('border-gray-300');
                    });
                    
                    // Add active state to selected method
                    this.classList.add('border-gray-800', 'bg-gray-50');
                    this.classList.remove('border-gray-300');
                    
                    // Check the radio button
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                    
                    // Show corresponding payment details
                    const method = this.dataset.method;
                    selectedPaymentMethod = method;
                    showPaymentDetails(method);
                });
            });
        });

        function showPaymentDetails(method) {
            // Hide all details
            document.getElementById('cashDetails').classList.add('hidden');
            document.getElementById('transferDetails').classList.add('hidden');
            
            // Show selected method details
            if (method === 'cash') {
                document.getElementById('cashDetails').classList.remove('hidden');
            } else if (method === 'transfer') {
                document.getElementById('transferDetails').classList.remove('hidden');
            }
            
            // Update pay button text
            updatePayButton(method);
        }

        function updatePayButton(method) {
            const payBtn = document.getElementById('payPenaltyBtn');
            if (method === 'cash') {
                payBtn.innerHTML = '<i class="fas fa-money-bill-wave mr-3"></i>Bayar Tunai - Rp 175.000';
            } else if (method === 'transfer') {
                payBtn.innerHTML = '<i class="fas fa-university mr-3"></i>Konfirmasi Transfer - Rp 175.000';
            }
        }

        // Pay penalty
        function payPenalty() {
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                return;
            }
            
            const confirmMessage = selectedPaymentMethod === 'cash' 
                ? 'Apakah Anda yakin ingin membayar denda secara tunai sebesar Rp 175.000?' 
                : 'Apakah Anda yakin telah melakukan transfer sebesar Rp 175.000?';
                
            if (confirm(confirmMessage)) {
                // Show loading state
                const payBtn = document.getElementById('payPenaltyBtn');
                payBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Memproses Pembayaran...';
                payBtn.disabled = true;
                
                setTimeout(() => {
                    // Update payment status
                    penaltyPaid = true;
                    document.getElementById('unpaidStatus').classList.add('hidden');
                    document.getElementById('paidStatus').classList.remove('hidden');
                    
                    // Hide pay button and payment methods
                    payBtn.classList.add('hidden');
                    document.getElementById('paymentMethods').classList.add('hidden');
                    
                    // Enable confirm return button
                    const confirmBtn = document.getElementById('confirmReturnBtn');
                    confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    confirmBtn.disabled = false;
                    
                    const successMessage = selectedPaymentMethod === 'cash' 
                        ? 'Pembayaran tunai berhasil dikonfirmasi!\n\nAnda sekarang dapat mengkonfirmasi pengembalian iPhone.' 
                        : 'Konfirmasi transfer berhasil!\n\nAnda sekarang dapat mengkonfirmasi pengembalian iPhone.';
                    
                    alert(successMessage);
                }, 800);
            }
        }

        // Confirm return
        function konfirmasiPengembalian() {
            if (!inspectionComplete) {
                alert('Menunggu pemeriksaan petugas selesai.');
                return;
            }
            
            if (hasPenalty && !penaltyPaid) {
                alert('Silakan bayar denda terlebih dahulu sebelum mengkonfirmasi pengembalian.');
                return;
            }
            
            if (confirm('Apakah Anda yakin ingin mengkonfirmasi pengembalian iPhone?')) {
                alert('Pengembalian berhasil dikonfirmasi!\n\nKTP Anda telah dikembalikan.\nTerima kasih telah menggunakan layanan iRentalKita!');
                // In real implementation:
                // Send confirmation to backend
                // Redirect to completion page
                window.location.href = 'dashboard-penyewa.html';
            }
        }

        // Simulate inspection completion (for demo)
        function simulateInspection() {
            setTimeout(() => {
                inspectionComplete = true;
                hasPenalty = true; // Simulate penalty found
                
                // Update inspection status
                document.getElementById('inspectionStatus').innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span class="font-semibold text-green-800">Pemeriksaan Selesai</span>
                    </div>
                    <p class="text-sm text-green-700 mt-1">Petugas telah menyelesaikan pemeriksaan</p>
                `;
                document.getElementById('inspectionStatus').className = 'bg-green-50 border border-green-200 rounded-lg p-4 mb-6';
                
                // Show inspection results
                document.getElementById('waitingInspection').classList.add('hidden');
                document.getElementById('inspectionResults').classList.remove('hidden');
                
                // Show penalty details
                document.getElementById('penaltyDetails').classList.remove('hidden');
                document.getElementById('paymentMethods').classList.remove('hidden');
                document.getElementById('paymentStatus').classList.remove('hidden');
                
                // Show pay penalty button
                document.getElementById('payPenaltyBtn').classList.remove('hidden');
                
                // Select cash payment by default
                document.querySelector('.payment-method[data-method="cash"]').click();
                
            }, 3000); // Simulate 3 second inspection
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
            // Start inspection simulation
            simulateInspection();
            
            console.log('Konfirmasi pengembalian page loaded');
        });
 </script>
@endpush


