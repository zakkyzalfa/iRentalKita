@extends('layouts.app')
@section('title', 'Bukti Pembayaran')
@section('content')
<section class="py-8 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-4">
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                <i class="fas fa-check text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h1>
            <p class="text-lg text-gray-800">Terima kasih, pesanan dan pembayaran Anda telah berhasil</p>
        </div>

        <!-- Receipt Main Content -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden relative">
            <!-- Receipt Top Edge (for visual effect) -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gray-100 border-b border-gray-200"></div>
            
            <div class="p-8 text-gray-800">
                <!-- Header of Receipt -->
                <div class="text-center mb-6 pb-4 border-b border-dashed border-gray-300">
                    <div class="flex items-center justify-center space-x-2 mb-2">
                        <i class="fas fa-mobile-alt text-2xl text-gray-800"></i>
                        <span class="text-2xl font-bold text-gray-800">iRentalKita</span>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mt-2">Bukti Pembayaran</h2>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->format('d M Y, H:i') }} WIB</p>
                </div>

                <!-- Receipt Details -->
                <div class="space-y-3 mb-6 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Nama Lengkap:</span>
                        <span class="font-medium text-gray-900">{{ $penyewa->nama ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Nomor Telepon:</span>
                        <span class="font-medium text-gray-900">{{ $penyewa->no_hp ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Tipe iPhone:</span>
                        <span class="font-medium text-gray-900">{{ $iphone->tipe_iphone ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Tanggal Mulai:</span>
                        <span class="font-medium text-gray-900">
                            {{ $pemesanan && $pemesanan->tanggal_sewa ? \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->format('d M Y') : '-' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Tanggal Kembali:</span>
                        <span class="font-medium text-gray-900">
                            {{ $pemesanan && $pemesanan->tanggal_kembali ? \Carbon\Carbon::parse($pemesanan->tanggal_kembali)->format('d M Y') : '-' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Durasi Sewa:</span>
                        <span class="font-medium text-gray-900">{{ $durasi ?? '-' }} hari</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-dashed border-gray-200">
                        <span class="text-gray-600">Metode Pembayaran:</span>
                        <span class="font-medium text-gray-900">{{ $pembayaran->metode_bayar }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b-2 border-gray-300 pt-2">
                        <span class="text-gray-600 text-base font-semibold">Total Pembayaran:</span>
                        <span class="font-bold text-lg text-gray-900">Rp {{ number_format($pembayaran->total_bayar) }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-600 text-base font-semibold">Jumlah Terbayar:</span>
                        <span class="font-bold text-lg text-green-600">Rp {{ number_format($pembayaran->total_bayar) }}</span>
                    </div>
                </div>

                <!-- Footer of Receipt -->
                <div class="text-center text-xs text-gray-500 pt-4 border-t border-dashed border-gray-300">
                    <p class="mb-1">Terima Kasih Telah Menggunakan Layanan iRentalKita!</p>
                    <p>Simpan struk ini sebagai bukti pembayaran Anda.</p>
                </div>
            </div>
            <!-- Receipt Bottom Edge (for visual effect) -->
            <div class="absolute bottom-0 left-0 w-full h-2 bg-gray-100 border-t border-gray-200"></div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            @if($pembayaran->metode_bayar === 'Tunai' && $pembayaran->status === 'Lunas')
                <a href="{{ route('dashboard-penyewa') }}" class="w-full sm:w-auto bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-colors flex items-center justify-center text-base">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Buka Dashboard
                </a>
            @else
                <button id="ambilBtn" class="w-full sm:w-auto bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-colors flex items-center justify-center text-base">
                    <i class="fas fa-hand-holding-heart mr-3"></i>
                    Ambil iPhone
                </button>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(!($pembayaran->metode_bayar === 'Tunai' && $pembayaran->status === 'Lunas'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ambilBtn = document.getElementById('ambilBtn');
    if (ambilBtn) {
        ambilBtn.addEventListener('click', function() {
            Swal.fire({
                icon: 'info',
                title: 'Ambil iPhone',
                text: 'Silahkan Datang ke lokasi untuk mengambil iPhone anda pada tanggal yang telah disepakati (tanggal mulai)',
                confirmButtonText: 'Oke'
            }).then(() => {
                window.location.href = "{{ route('konfirmasi.pengambilan', $pembayaran->id_pemesanan) }}";
            });
        });
    }
});
</script>
@endif
@endpush
