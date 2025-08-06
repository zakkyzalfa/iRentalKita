@extends('layouts.app')

@section('title', 'Detail iPhone')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border-2 border-gray-200">
                    <img src="{{ $iphone->gambar ?: asset('img/default-iphone.png') }}" alt="{{ $iphone->tipe_iphone }}" class="w-full h-full object-cover" id="mainImage">
                </div>
            </div>
            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $iphone->tipe_iphone }}</h1>
                        @if($iphone->status == 'tersedia')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-check-circle mr-1"></i>
                                Tersedia
                            </span>
                        @else
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-times-circle mr-1"></i>
                                Disewa
                            </span>
                        @endif
                    </div>
                    <p class="text-xl text-gray-600">{{ $iphone->warna }}</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl">
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-bold text-gray-900">Rp {{ number_format($iphone->harga_per_hari) }}</span>
                        <span class="text-xl text-gray-600">/hari</span>
                    </div>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Spesifikasi iPhone :</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex"><span class="font-medium text-gray-900 w-40 flex-shrink-0">• Warna</span><span>: {{ $iphone->warna }}</span></li>
                        <li class="flex"><span class="font-medium text-gray-900 w-40 flex-shrink-0">• IMEI</span><span>: {{ $iphone->imei }}</span></li>
                        <li class="flex"><span class="font-medium text-gray-900 w-40 flex-shrink-0">• Kondisi</span><span>: {{ ucfirst($iphone->kondisi) }}</span></li>
                    </ul>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Form Pemesanan</h3>
                    <div id="alertError"></div>
                    <form id="rentalForm" class="space-y-4">
                    @csrf
                        <div>
                            <label for="startDate" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" id="startDate" name="tanggal_sewa" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300" required>
                        </div>
                        <div>
                            <label for="endDate" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kembali</label>
                            <input type="date" id="endDate" name="tanggal_kembali" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300" required>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700">Durasi Sewa:</span>
                                <span id="rentalDuration" class="text-sm font-semibold text-gray-800">0 hari</span>
                            </div>
                            <div class="flex justify-between items-center text-lg font-semibold">
                                <span>Total Biaya Sewa:</span>
                                <span id="totalPrice" class="text-gray-800">Rp 0</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <button type="submit" id="btnSewa" class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Sewa Sekarang
                            </button>
                            <button type="button" onclick="window.location.href='{{ route('daftar-iphone') }}'" class="w-full bg-transparent text-gray-800 py-3 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Daftar iPhone
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kalender icon pointer & focus
    document.querySelectorAll('.calendar-icon').forEach(function(icon){
        icon.addEventListener('click', function() {
            const inputTarget = document.getElementById(this.dataset.target);
            if(inputTarget) inputTarget.focus();
        });
    });

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('startDate').setAttribute('min', today);
    document.getElementById('startDate').value = today;

    function calculateRental() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const timeDiff = end.getTime() - start.getTime();
            const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
            if (daysDiff > 0) {
                const pricePerDay = {{ $iphone->harga_per_hari }};
                const totalPrice = daysDiff * pricePerDay;
                document.getElementById('rentalDuration').textContent = `${daysDiff} hari`;
                document.getElementById('totalPrice').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
            } else {
                document.getElementById('rentalDuration').textContent = '0 hari';
                document.getElementById('totalPrice').textContent = 'Rp 0';
            }
        } else {
            document.getElementById('rentalDuration').textContent = '0 hari';
            document.getElementById('totalPrice').textContent = 'Rp 0';
        }
    }

    document.getElementById('startDate').addEventListener('change', function() {
        const startDate = this.value;
        const endDateInput = document.getElementById('endDate');
        if (startDate) {
            const minEndDate = new Date(startDate);
            minEndDate.setDate(minEndDate.getDate() + 1);
            endDateInput.setAttribute('min', minEndDate.toISOString().split('T')[0]);
            if (endDateInput.value && new Date(endDateInput.value) <= new Date(startDate)) {
                endDateInput.value = '';
            }
        }
        calculateRental();
    });

    document.getElementById('endDate').addEventListener('change', calculateRental);
    calculateRental();

    // Handle AJAX submit with SweetAlert2
    document.getElementById('rentalForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const startDate = form.querySelector('[name="tanggal_sewa"]').value;
        const endDate = form.querySelector('[name="tanggal_kembali"]').value;
        const csrf = form.querySelector('input[name="_token"]').value;
        const alertError = document.getElementById('alertError');
        alertError.innerHTML = '';

        // Validasi manual sebelum submit (opsional)
        if (!startDate || !endDate) {
            Swal.fire('Error', 'Mohon lengkapi tanggal mulai dan tanggal kembali', 'error');
            return;
        }
        if (new Date(endDate) <= new Date(startDate)) {
            Swal.fire('Error', 'Tanggal kembali harus setelah tanggal mulai', 'error');
            return;
        }

        // Disable button
        const btnSewa = document.getElementById('btnSewa');
        btnSewa.disabled = true;
        btnSewa.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';

        try {
            const response = await fetch('{{ route("sewa.proses", $iphone->id_iphone) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    tanggal_sewa: startDate,
                    tanggal_kembali: endDate,
                }),
            });

            // Tambahkan delay agar animasi terlihat sebentar (1 detik)
            setTimeout(async () => {
                btnSewa.disabled = false;
                btnSewa.innerHTML = '<i class="fas fa-shopping-cart mr-2"></i> Sewa Sekarang';

                if (response.ok) {
                    const data = await response.json();
                    Swal.fire({
                        icon: 'success',
                        title: 'Pemesanan Berhasil!',
                        text: 'Silahkan lanjut ke pembayaran!',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    const err = await response.json();
                    Swal.fire('Gagal', err.message || 'Terjadi kesalahan.', 'error');
                }
            }, 0);
        } catch (err) {
            btnSewa.disabled = false;
            btnSewa.innerHTML = '<i class="fas fa-shopping-cart mr-2"></i> Sewa Sekarang';
            Swal.fire('Gagal', 'Terjadi kesalahan sistem.', 'error');
        }
    });
});
</script>
@endpush