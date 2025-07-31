@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Payment Section -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-6xl mx-auto px-8 mb-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
                <p class="text-lg text-gray-600">Selesaikan pembayaran untuk konfirmasi rental iPhone Anda</p>
            </div>
        </div>

        <!-- Main Content with 40:60 Layout -->
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
                        </div>

                        <!-- Total -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total Pembayaran:</span>
                                <span class="text-xl font-bold text-gray-900" id="totalAmount">Rp 250.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran - 60% (3 columns) -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        
                        <!-- Payment Methods -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-credit-card mr-3 text-gray-600"></i>
                                Pilih Metode Pembayaran
                            </h2>
                            
                            <div class="space-y-4">
                                <!-- Bank Transfer Section -->
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-3">Transfer Bank</h3>
                                    <div class="payment-method border-2 border-gray-300 rounded-xl p-4 cursor-pointer hover:border-gray-800 transition-all duration-300" data-method="bank">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <input type="radio" id="bank" name="paymentMethod" value="bank" class="mr-3 text-gray-800 focus:ring-gray-800">
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">Transfer Bank</h4>
                                                    <p class="text-xs text-gray-600">BCA, BNI, BRI, Mandiri</p>
                                                </div>
                                            </div>
                                            <i class="fas fa-university text-2xl text-gray-600"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cash Payment Section -->
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-3">Pembayaran Tunai</h3>
                                    <div class="payment-method border-2 border-gray-800 rounded-xl p-4 cursor-pointer transition-all duration-300" data-method="cash">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <input type="radio" id="cash" name="paymentMethod" value="cash" checked class="mr-3 text-gray-800 focus:ring-gray-800">
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">Bayar di Tempat</h4>
                                                    <p class="text-xs text-gray-600">Bayar langsung saat pengambilan iPhone</p>
                                                </div>
                                            </div>
                                            <i class="fas fa-money-bill-wave text-2xl text-gray-600"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pembayaran</h3>
                            
                            <div id="paymentDetails">
                                <!-- Cash Details (Default) -->
                                <div id="cashDetails">
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Pembayaran Tunai
                                        </h4>
                                        <div class="space-y-2 text-sm text-gray-700">
                                            <p>• Bayar langsung saat pengambilan iPhone</p>
                                            <p>• Lokasi: Toko iRentalKita</p>
                                            <p>• Bawa KTP asli untuk sebagai jaminan</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Details -->
                                <div id="bankDetails" class="hidden">
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                            <i class="fas fa-university mr-2"></i>
                                            Detail Transfer Bank
                                        </h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <span class="text-gray-600">Bank:</span>
                                                <span class="font-medium ml-2">BCA</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">No. Rekening:</span>
                                                <span class="font-medium ml-2">1234567890</span>
                                            </div>
                                            <div>
                                                <span class="text-gray-600">Atas Nama:</span>
                                                <span class="font-medium ml-2">iRentalKita</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <div class="space-y-4">
                                <button type="button" id="paymentBtn" class="w-full bg-gray-800 text-white py-4 px-6 rounded-xl font-semibold hover:bg-gray-700 transition-all duration-300 flex items-center justify-center text-lg">
                                    <i class="fas fa-lock mr-3"></i>
                                    <span id="paymentText">Bayar Sekarang - Rp 250.000</span>
                                    <i id="paymentSpinner" class="fas fa-spinner fa-spin ml-3 hidden"></i>
                                </button>
                                
                                <button type="button" onclick="history.back()" class="w-full bg-transparent text-gray-800 py-4 px-6 rounded-xl font-semibold border-2 border-gray-300 hover:border-gray-800 hover:bg-gray-50 transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-arrow-left mr-3"></i>
                                    Kembali ke Detail iPhone
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
    // Payment method selection
    document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                // Remove active state from all methods
                document.querySelectorAll('.payment-method').forEach(m => {
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
                showPaymentDetails(method);
                updatePaymentButton(method);
            });
        });

        function showPaymentDetails(method) {
            // Hide all details
            document.getElementById('cashDetails').classList.add('hidden');
            document.getElementById('bankDetails').classList.add('hidden');
            
            // Show selected method details
            if (method === 'cash') {
                document.getElementById('cashDetails').classList.remove('hidden');
            } else if (method === 'bank') {
                document.getElementById('bankDetails').classList.remove('hidden');
            }
        }

        function updatePaymentButton(method) {
            const paymentText = document.getElementById('paymentText');
            const methodNames = {
                'cash': 'Konfirmasi Pesanan',
                'bank': 'Konfirmasi Transfer Bank'
            };
            
            paymentText.textContent = `${methodNames[method]} - Rp 250.000`;
        }

        // Payment processing
        document.getElementById('paymentBtn').addEventListener('click', function() {
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
            const paymentText = document.getElementById('paymentText');
            const paymentSpinner = document.getElementById('paymentSpinner');
            
            // Show loading state
            paymentText.textContent = 'Memproses Pembayaran...';
            paymentSpinner.classList.remove('hidden');
            this.disabled = true;
            this.classList.add('opacity-75', 'cursor-not-allowed');
            
            // Simulate payment processing
            setTimeout(() => {
                // Reset button state
                updatePaymentButton(paymentMethod);
                paymentSpinner.classList.add('hidden');
                this.disabled = false;
                this.classList.remove('opacity-75', 'cursor-not-allowed');
                
                // Show success message based on payment method
                const totalAmount = document.getElementById('totalAmount').textContent;
                let message = `Pembayaran Berhasil Diproses!\n\nMetode: ${getPaymentMethodName(paymentMethod)}\nTotal: ${totalAmount}\n\n`;
                
                if (paymentMethod === 'cash') {
                    message += 'Pesanan Anda telah dikonfirmasi!\nSilakan datang ke kantor kami untuk pengambilan dan pembayaran.\n\nAlamat: Kantor iRentalKita, Bandung\nJam: 09:00 - 17:00 WIB';
                } else if (paymentMethod === 'bank') {
                    message += 'Detail transfer telah dikirim ke email Anda.\nSilakan transfer dalam 24 jam.';
                }
                
                message += '\n\nAkan redirect ke halaman konfirmasi - integrasi dengan Laravel';
                
                alert(message);
                
                // In real implementation, redirect to confirmation page
                window.location.href = 'bukti-pembayaran.html';
            }, 800);
        });

        function getPaymentMethodName(method) {
            const names = {
                'cash': 'Bayar di Tempat',
                'bank': 'Transfer Bank'
            };
            return names[method] || method;
        }

        // Initialize default payment method
        showPaymentDetails('cash');
        
        // Smooth scroll for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
 </script>
@endpush


