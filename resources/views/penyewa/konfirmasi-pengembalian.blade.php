@extends('layouts.app')

@section('title', 'Konfirmasi Pengembalian')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="max-w-4xl mx-auto px-8 mb-8">
        <div class="text-center">
            <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-undo text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Konfirmasi Pengembalian iPhone</h1>
            <p class="text-lg text-gray-800">Status pemeriksaan dan pengembalian iPhone Anda</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-receipt mr-3 text-gray-600"></i> Rincian Pemesanan
                    </h2>
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Nama Lengkap:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->penyewa->nama ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tipe iPhone:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->iphone->tipe_iphone ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">IMEI:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->iphone->imei ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Biaya Sewa Per Hari:</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($pemesanan->iphone->harga_per_hari ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tanggal Mulai:</span>
                            <span class="font-medium text-gray-900">
                                {{ isset($pemesanan->tanggal_sewa) ? \Carbon\Carbon::parse($pemesanan->tanggal_sewa)->translatedFormat('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tanggal Kembali:</span>
                            <span class="font-medium text-gray-900">
                                {{ isset($pemesanan->tanggal_kembali) ? \Carbon\Carbon::parse($pemesanan->tanggal_kembali)->translatedFormat('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Durasi Sewa:</span>
                            <span class="font-medium text-gray-900">{{ $durasi }} hari</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($pemesanan->pembayaran->total_bayar ?? 0, 0, ',', '.') }}</span>
                        </div>
                        @if(isset($pemesanan->pembayaran))
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Status Pembayaran:</span>
                            <span class="font-medium text-gray-900">{{ $pemesanan->pembayaran->status ?? '-' }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Status Pemeriksaan -->
                    <div class="@if(!$pemesanan->pengembalian) bg-yellow-50 border-yellow-200 @else bg-green-50 border-green-200 @endif border rounded-lg p-4 mb-6">
                        @if(!$pemesanan->pengembalian)
                            <div class="flex items-center">
                                <i class="fas fa-search text-yellow-600 mr-2"></i>
                                <span class="font-semibold text-yellow-800">Sedang Diperiksa</span>
                            </div>
                            <p class="text-sm text-yellow-700 mt-1">Petugas sedang memeriksa kondisi iPhone</p>
                        @else
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                <span class="font-semibold text-green-800">Pemeriksaan Selesai</span>
                            </div>
                            <p class="text-sm text-green-700 mt-1">Petugas telah menyelesaikan pemeriksaan</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kolom kanan: hasil pemeriksaan, denda, aksi -->
            <div class="lg:col-span-3">
                <div class="space-y-6">
                    <!-- Hasil Pemeriksaan -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-clipboard-list mr-3 text-gray-600"></i>
                            Hasil Pemeriksaan Petugas
                        </h2>
                        @if(!$pemesanan->pengembalian)
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-hourglass-half text-yellow-600 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Menunggu Pemeriksaan</h3>
                                <p class="text-gray-600">Petugas sedang memeriksa kondisi iPhone dan aksesoris Anda</p>
                            </div>
                            <button type="button" onclick="window.location.href='{{ route('dashboard-penyewa') }}'" class="w-full bg-transparent text-gray-800 py-3 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Dashboard
                            </button>
                        @else
                            @php
                                $labels = [
                                    'layar' => 'Layar',
                                    'kamera' => 'Kamera',
                                    'body' => 'Body',
                                    'kemasan' => 'Box iPhone',
                                    'charger' => 'Charger',
                                    'keterlambatan' => 'Keterlambatan',
                                ];
                                $icons = [
                                    'layar' => 'fa-mobile-alt',
                                    'kamera' => 'fa-camera',
                                    'body' => 'fa-tablet-alt',
                                    'kemasan' => 'fa-box',
                                    'charger' => 'fa-plug',
                                    'keterlambatan' => 'fa-clock',
                                ];
                                // Mapping denda per komponen
                                $denda_mapping = [
                                    'layar'    => ['rusak' => 750000],
                                    'kamera'   => ['rusak' => 500000],
                                    'body'     => ['rusak' => 400000],
                                    'kemasan'  => ['hilang' => 100000],
                                    'charger'  => ['hilang' => 500000],
                                ];
                                $denda_terlambat_per_hari = 600000;
                            @endphp
                            <div class="space-y-2 mb-6">
                                @foreach(($pemesanan->pengembalian->kondisi_kembali ?? []) as $item => $val)
                                    @if(isset($labels[$item]))
                                    <div class="flex items-center justify-between p-3 @if($val == 'baik' || $val == 'ada' || $val == 'normal') bg-green-50 @else bg-red-50 @endif rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas {{ $icons[$item] ?? 'fa-info-circle' }} mr-3 text-{{ ($val=='baik'||$val=='ada'||$val=='normal')?'green':'red' }}-600"></i>
                                            <span class="font-medium text-gray-900">{{ $labels[$item] }}</span>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <span class="text-sm font-medium @if($val == 'baik' || $val == 'ada' || $val == 'normal') text-green-600 @else text-red-600 @endif">
                                                {{ ucfirst($val) }}
                                            </span>
                                            @if(isset($denda_mapping[$item][$val]))
                                            <span class="text-xs font-semibold text-red-700 mt-1">
                                                Denda: Rp {{ number_format($denda_mapping[$item][$val], 0, ',', '.') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                @if(isset($pemesanan->pengembalian->keterlambatan_hari) && $pemesanan->pengembalian->keterlambatan_hari > 0)
                                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-3 text-red-600"></i>
                                        <span class="font-medium text-gray-900">Keterlambatan</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-sm font-medium text-red-600">
                                            {{ $pemesanan->pengembalian->keterlambatan_hari }} hari
                                        </span>
                                        <span class="text-xs font-semibold text-red-700 mt-1">
                                            Denda: Rp {{ number_format($pemesanan->pengembalian->keterlambatan_hari * $denda_terlambat_per_hari, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            {{-- Denda --}}
                            @if($pemesanan->pengembalian->denda > 0)
                                <div class="bg-red-100 border border-red-300 rounded-lg p-4 mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-red-800">Total Denda:</span>
                                        <span class="text-2xl font-bold text-red-800">Rp {{ number_format($pemesanan->pengembalian->denda,0,',','.') }}</span>
                                    </div>
                                    <div class="text-sm text-red-700 mt-2">
                                        <ul class="list-disc pl-4">
                                            @php
                                              $dendaDetail = $pemesanan->pengembalian->denda_detail ?? [];
                                            @endphp
                                            @foreach($dendaDetail as $komp => $nom)
                                                <li>{{ $labels[$komp] ?? ucfirst($komp) }}: Rp {{ number_format($nom,0,',','.') }}</li>
                                            @endforeach
                                            @if(isset($pemesanan->pengembalian->denda_keterlambatan) && $pemesanan->pengembalian->denda_keterlambatan > 0)
                                                <li>Keterlambatan: Rp {{ number_format($pemesanan->pengembalian->denda_keterlambatan,0,',','.') }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @if($pemesanan->pengembalian->status_bayar !== 'lunas')
                                <form action="{{ route('konfirmasi.pengembalian.bayar-denda', $pemesanan->id_pemesanan) }}" method="POST" class="mb-4 space-y-4" id="paymentForm">
                                    @csrf
                                    <label class="block mb-2 font-medium">Pilih Metode Pembayaran:</label>
                                    <div class="space-y-4">
                                        <!-- Cash Payment Option -->
                                        <div class="payment-method border-2 border-gray-300 rounded-xl p-4 cursor-pointer hover:border-gray-800 transition-all duration-300" data-method="cash">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <input type="radio" id="cash" name="metode_bayar" value="tunai" class="mr-3 text-gray-800 focus:ring-gray-800" required>
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
                                                    <input type="radio" id="transfer" name="metode_bayar" value="transfer" class="mr-3 text-gray-800 focus:ring-gray-800" required>
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
                                        <div id="cashDetails" class="bg-gray-50 border border-gray-200 rounded-lg p-4 hidden">
                                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Pembayaran Tunai
                                            </h4>
                                            <div class="space-y-2 text-sm text-gray-700">
                                                <p>• Bayar langsung di tempat saat pengembalian iPhone</p>
                                                <p>• Siapkan uang pas sebesar Rp {{ number_format($pemesanan->pengembalian->denda,0,',','.') }}</p>
                                                <p>• KTP akan dikembalikan setelah pembayaran</p>
                                            </div>
                                        </div>

                                        <!-- Transfer Details -->
                                        <div id="transferDetails" class="bg-gray-50 border border-gray-200 rounded-lg p-4 hidden">
                                            <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                <i class="fas fa-university mr-2"></i>
                                                Detail Transfer Bank
                                            </h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <span class="text-gray-700">Bank:</span>
                                                    <span class="font-medium ml-2 text-gray-900">BCA</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-700">No. Rekening:</span>
                                                    <span class="font-medium ml-2 text-gray-900">1234567890</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-700">Atas Nama:</span>
                                                    <span class="font-medium ml-2 text-gray-900">iRentalKita</span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-700">Jumlah:</span>
                                                    <span class="font-medium ml-2 text-gray-900">Rp {{ number_format($pemesanan->pengembalian->denda,0,',','.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <button id="payPenaltyBtn" type="button"
                                class="w-full bg-red-600 text-white py-3 px-5 text-lg rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-red-600 hover:text-red-600 border-2 border-red-600 transition-all duration-300">
                                    <i class="fas fa-credit-card mr-3"></i>
                                    Bayar Denda - Rp {{ number_format($pemesanan->pengembalian->denda,0,',','.') }}
                                </button>
                                </form>
                                    <label class="block mb-2 font-medium">Status Pembayaran Denda:</label>
                                    <!-- Unpaid Status -->
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
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
                                    <button class="w-full bg-gray-500 text-white py-3 px-4 rounded-lg font-medium opacity-50 cursor-not-allowed" disabled>
                                        <i class="fas fa-check mr-3"></i>
                                        Konfirmasi Pengembalian
                                    </button>
                                @else
                                    <!-- Paid Status -->
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
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
                                    <form id="formKonfirmasiPengembalian" action="{{ route('konfirmasi.pengembalian.konfirmasi', $pemesanan->id_pemesanan) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-green-600 hover:text-green-600 border-2 border-green-600 transition-all duration-300 flex items-center justify-center text-lg">
                                            <i class="fas fa-check mr-3"></i>
                                            Konfirmasi Pengembalian
                                        </button>
                                    </form>
                                @endif
                            @else
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                        <div class="flex items-center justify-between mb-3">
                                            <div>
                                                <h3 class="font-semibold text-green-800">Tidak ada denda</h3>
                                                <p class="text-sm text-green-600">iPhone dikembalikan dalam kondisi baik</p>
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
                                <form id="formKonfirmasiPengembalian" action="{{ route('konfirmasi.pengembalian.konfirmasi', $pemesanan->id_pemesanan) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-green-600 hover:text-green-600 border-2 border-green-600 transition-all duration-300 flex items-center justify-center text-lg">
                                            <i class="fas fa-check mr-3"></i>
                                            Konfirmasi Pengembalian
                                        </button>
                                    </form>
                            @endif
                        @endif
                    </div>
                    
                    <!-- Informasi Penting -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('payPenaltyBtn');
    var paymentForm = document.getElementById('paymentForm');
    var konfirmasiForm = document.getElementById('formKonfirmasiPengembalian');

    // BAYAR DENDA: SweetAlert2 Konfirmasi, submit form setelah Oke
    if(btn && paymentForm) {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Denda Berhasil Dibayar!',
                text: 'Sekarang anda bisa mengambil KTP anda dan melakukan konfirmasi pengembalian.',
                confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.isConfirmed) {
                    paymentForm.submit();
                }
            });
        });
    }

    // KONFIRMASI PENGEMBALIAN: SweetAlert2 Konfirmasi, submit form setelah Oke
    if (konfirmasiForm) {
        konfirmasiForm.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Konfirmasi Pengembalian',
                text: 'Silahkan Komfirmasi Jika anda telah mengambalikan iPhone dan menerima KTP anda',
                confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.isConfirmed) {
                    konfirmasiForm.submit();
                }
            });
        });
    }

    // Payment card clickable and show detail
    document.querySelectorAll('.payment-method').forEach(function(card) {
        card.addEventListener('click', function(e) {
            // Check the radio on card click
            const input = card.querySelector('input[type="radio"]');
            input.checked = true;

            // Highlight the active card
            document.querySelectorAll('.payment-method').forEach(function(other) {
                other.classList.remove('border-gray-800', 'bg-gray-50');
                other.classList.add('border-gray-300');
            });
            card.classList.remove('border-gray-300');
            card.classList.add('border-gray-800', 'bg-gray-50');

            // Show payment details
            document.getElementById('cashDetails').classList.add('hidden');
            document.getElementById('transferDetails').classList.add('hidden');
            if(input.value === 'tunai') {
                document.getElementById('cashDetails').classList.remove('hidden');
            }
            if(input.value === 'transfer') {
                document.getElementById('transferDetails').classList.remove('hidden');
            }
        });

        // For accessibility: if radio is focused/clicked directly
        const input = card.querySelector('input[type="radio"]');
        input.addEventListener('change', function(e) {
            // Trigger the same as clicking card
            card.click();
        });
    });
});
</script>
@endpush