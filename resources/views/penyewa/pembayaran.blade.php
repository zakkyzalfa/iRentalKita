@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <!-- Progress Bar Stepper -->
    <div class="flex justify-center mb-8 mt-2">
        <ol class="flex items-center space-x-8">
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-800 text-white font-bold">1</div>
                <span class="ml-2 font-semibold text-gray-800">Pemesanan</span>
            </li>
            <li>
                <div class="w-10 h-0.5 bg-gray-800 mx-2"></div>
            </li>
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-800 text-white font-bold">2</div>
                <span class="ml-2 font-semibold text-gray-800">Pembayaran</span>
            </li>
            <li>
                <div class="w-10 h-0.5 bg-gray-300 mx-2"></div>
            </li>
            <li class="flex items-center">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-gray-800 font-bold">3</div>
                <span class="ml-2 font-semibold text-gray-800">Ambil iPhone</span>
            </li>
        </ol>
    </div>

    <div class="max-w-4xl mx-auto px-8 mb-8">
        <div class="text-center">
            <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-money-bill-wave text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
            <p class="text-lg text-gray-800">Selesaikan pembayaran untuk konfirmasi rental iPhone Anda</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-receipt mr-3 text-gray-800"></i>
                        Rincian Pemesanan
                    </h2>
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">Nama Lengkap:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->penyewa->nama }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">Tipe iPhone:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->iphone->tipe_iphone }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">IMEI:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->iphone->imei }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">Biaya Sewa Per Hari:</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($pemesanan->iphone->harga_per_hari) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">Tanggal Mulai:</span>
                            <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">Tanggal Kembali:</span>
                            <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($pemesanan->tanggal_kembali)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-800">Durasi Sewa:</span>
                            <span class="font-medium text-gray-900">{{ $durasi }} hari</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total Pembayaran:</span>
                            <span class="text-xl font-bold text-gray-900">Rp {{ number_format($total) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Metode & Konfirmasi Pembayaran -->
            <div class="lg:col-span-3">
                <div class="space-y-6">
                    <!-- Pilih Metode -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-credit-card mr-3 text-gray-800"></i>
                            Pilih Metode Pembayaran
                        </h2>
                        <form id="paymentForm" method="POST" action="#">
                            @csrf
                            <div class="space-y-4">
                                <!-- Transfer Bank -->
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-3">Transfer Bank</h3>
                                    <div class="payment-method border-2 border-gray-300 rounded-xl p-4 cursor-pointer hover:border-gray-800 transition-all duration-300" data-method="bank">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <input type="radio" id="bank" name="paymentMethod" value="bank" class="mr-3 text-gray-800 focus:ring-gray-800">
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">Transfer Bank</h4>
                                                    <p class="text-xs text-gray-800">BCA, BNI, BRI, Mandiri</p>
                                                </div>
                                            </div>
                                            <i class="fas fa-university text-2xl text-gray-800"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tunai -->
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-3">Pembayaran Tunai</h3>
                                    <div class="payment-method border-2 border-gray-800 rounded-xl p-4 cursor-pointer transition-all duration-300" data-method="cash">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <input type="radio" id="cash" name="paymentMethod" value="cash" checked class="mr-3 text-gray-800 focus:ring-gray-800">
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">Bayar di Tempat</h4>
                                                    <p class="text-xs text-gray-800">Bayar langsung saat pengambilan iPhone</p>
                                                </div>
                                            </div>
                                            <i class="fas fa-money-bill-wave text-2xl text-gray-800"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </form>
                    </div>
                    <!-- Detail Pembayaran -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pembayaran</h3>
                        <div id="paymentDetails">
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
                            <div id="bankDetails" class="hidden">
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                        <i class="fas fa-university mr-2"></i>
                                        Detail Transfer Bank
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-800">Bank:</span>
                                            <span class="font-medium ml-2">BCA</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-800">No. Rekening:</span>
                                            <span class="font-medium ml-2">1234567890</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-800">Atas Nama:</span>
                                            <span class="font-medium ml-2">iRentalKita</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <div class="space-y-4">
                            <button type="button" id="paymentBtn" class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300">
                                <i class="fas fa-lock mr-3"></i>
                                <span id="paymentText">Bayar Sekarang - Rp {{ number_format($total) }}</span>
                                <i id="paymentSpinner" class="fas fa-spinner fa-spin ml-3 hidden"></i>
                            </button>
                            <button type="button" onclick="history.back()" class="w-full bg-transparent text-gray-800 py-3 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-all duration-300">
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
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Pemesanan Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonText: 'Oke'
    });
</script>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            document.querySelectorAll('.payment-method').forEach(m => {
                m.classList.remove('border-gray-800', 'bg-gray-50');
                m.classList.add('border-gray-300');
            });
            this.classList.add('border-gray-800', 'bg-gray-50');
            this.classList.remove('border-gray-300');
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            const methodType = this.dataset.method;
            showPaymentDetails(methodType);
            updatePaymentButton(methodType);
        });
    });

    function showPaymentDetails(method) {
        document.getElementById('cashDetails').classList.add('hidden');
        document.getElementById('bankDetails').classList.add('hidden');
        if (method === 'cash') {
            document.getElementById('cashDetails').classList.remove('hidden');
        } else if (method === 'bank') {
            document.getElementById('bankDetails').classList.remove('hidden');
        }
    }
    function updatePaymentButton(method) {
        const paymentText = document.getElementById('paymentText');
        const nominal = '{{ number_format($total) }}';
        const methodNames = {
            'cash': 'Konfirmasi Pesanan',
            'bank': 'Konfirmasi Transfer Bank'
        };
        paymentText.textContent = `${methodNames[method]} - Rp ${nominal}`;
    }

    document.getElementById('paymentBtn').addEventListener('click', async function(e) {
        e.preventDefault();
        const method = document.querySelector('input[name="paymentMethod"]:checked').value;
        const csrf = document.querySelector('input[name="_token"]').value;
        const paymentSpinner = document.getElementById('paymentSpinner');
        paymentSpinner.classList.remove('hidden');
        this.disabled = true;

        try {
            const response = await fetch("{{ route('pembayaran.proses', $pemesanan->id_pemesanan) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    metode_pembayaran: method
                }),
            });

            paymentSpinner.classList.add('hidden');
            this.disabled = false;

            if (response.ok) {
                const data = await response.json();
                if(method === 'bank') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil',
                        text: 'Pembayaran Berhasil, Mohon datang ke lokasi untuk mengambil iPhone anda',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Tunai!',
                        text: 'Lakukan Pembayaran Tunai pada saat pengambilan iphone, Silahkan Datang ke lokasi pada tanggal yang telah disepakati (tanggal mulai)',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                }
            } else {
                const err = await response.json();
                Swal.fire('Gagal', err.message || 'Terjadi kesalahan.', 'error');
            }
        } catch (err) {
            paymentSpinner.classList.add('hidden');
            this.disabled = false;
            Swal.fire('Gagal', 'Terjadi kesalahan sistem.', 'error');
        }
    });

    // Init
    showPaymentDetails('cash');
    updatePaymentButton('cash');
});
</script>
@endpush