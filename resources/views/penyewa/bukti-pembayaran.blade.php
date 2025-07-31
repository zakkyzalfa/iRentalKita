@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Success Section -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Success Header -->
        <div class="max-w-4xl mx-auto px-8 mb-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h1>
                <p class="text-lg text-gray-600">Terima kasih, pesanan Anda telah dikonfirmasi</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-2xl mx-auto px-8">
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-8">
        
                <!-- Header -->
                <div class="text-center mb-8 pb-6 border-b-2 border-gray-200">
                    <div class="flex items-center justify-center space-x-2 mb-2">
                        <i class="fas fa-mobile-alt text-2xl text-gray-800"></i>
                        <span class="text-2xl font-bold text-gray-800">iRentalKita</span>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Bukti Pembayaran</h2>
                </div>

                <!-- Receipt Details -->
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Nama Lengkap:</span>
                        <span class="font-semibold text-gray-900">John Doe</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Nomor Telepon:</span>
                        <span class="font-semibold text-gray-900">+62 812-3456-7890</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Tipe iPhone:</span>
                        <span class="font-semibold text-gray-900">iPhone 15 Pro Max 256GB</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Tanggal Mulai:</span>
                        <span class="font-semibold text-gray-900">20 Januari 2025</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Tanggal Kembali:</span>
                        <span class="font-semibold text-gray-900">25 Januari 2025</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Durasi Sewa:</span>
                        <span class="font-semibold text-gray-900">5 hari</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Total Pembayaran:</span>
                        <span class="font-semibold text-gray-900">Rp 250.000</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Tanggal Transaksi:</span>
                        <span class="font-semibold text-gray-900" id="transactionDate">20 Januari 2025, 14:30 WIB</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-medium">Metode Pembayaran:</span>
                        <span class="font-semibold text-gray-900" id="paymentMethodSimple">Bayar di Tempat</span>
                    </div>
                    <div class="flex justify-between py-2 border-t-2 border-gray-200 pt-4">
                        <span class="text-gray-600 font-medium">Jumlah Terbayar:</span>
                        <span class="font-bold text-lg text-green-600">Rp 250.000</span>
                    </div>
                </div>

                

            </div>

            <!-- Action Buttons - Outside Receipt -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="downloadPDF()" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-blue-600 hover:text-blue-600 border-2 border-blue-600 transition-all duration-300 flex items-center justify-center text-lg">
                    <i class="fas fa-download mr-3"></i>
                    Download Bukti
                </button>
                <button onclick="goToPengambilan()" class="bg-gray-800 text-white px-8 py-4 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300 flex items-center justify-center text-lg">
                    <i class="fas fa-hand-holding-heart mr-3"></i>
                    Ambil iPhone
                </button>
            </div>
        </div>

            
        </div>
    </section>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
    // Set current date and time
    function setCurrentDateTime() {
            const now = new Date();
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'Asia/Jakarta'
            };
            const formattedDate = now.toLocaleDateString('id-ID', options) + ' WIB';
            document.getElementById('paymentDate').textContent = formattedDate;
        }

        // Print receipt function
        function printReceipt() {
            window.print();
        }

        // Download PDF function
        function downloadPDF() {
            alert('Fitur download PDF akan diintegrasikan dengan library PDF generator (jsPDF/Puppeteer)');
            // In real implementation:
            // Generate PDF using jsPDF or server-side PDF generation
        }

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                alert('Logout berhasil - akan redirect ke halaman login');
                // window.location.href = 'login.html';
            }
        }

        // Go to pickup function
        function goToPengambilan() {
            alert('Mengarahkan ke informasi pengambilan iPhone...\n\nLokasi: Kantor iRentalKita, Bandung\nJam: 09:00 - 17:00 WIB\nBawa: KTP asli + bukti pembayaran');
            // In real implementation:
            window.location.href = 'konfirmasi-pengambilan.html';
        }

        // Update the initialization part
        document.addEventListener('DOMContentLoaded', function() {
            setCurrentDateTime();
            
            // Set transaction date
            const now = new Date();
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'Asia/Jakarta'
            };
            const formattedDate = now.toLocaleDateString('id-ID', options) + ' WIB';
            document.getElementById('transactionDate').textContent = formattedDate;
            
            // Get payment method from URL params or localStorage
            const urlParams = new URLSearchParams(window.location.search);
            const paymentMethod = urlParams.get('method') || localStorage.getItem('paymentMethod') || 'cash';
            
            const methodNames = {
                'cash': 'Bayar di Tempat',
                'bank': 'Transfer Bank'
            };
            
            document.getElementById('paymentMethodSimple').textContent = methodNames[paymentMethod] || 'Bayar di Tempat';
        });

        // Auto-refresh page every 30 seconds to update time
        setInterval(setCurrentDateTime, 30000);
 </script>
@endpush


