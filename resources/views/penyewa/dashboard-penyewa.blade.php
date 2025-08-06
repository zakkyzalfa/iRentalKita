@extends('layouts.app')

@section('title', 'Dashboard Penyewa')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::guard('penyewa')->user()->nama }}!</h1>
                    <p class="text-blue-100 text-lg">Kelola rental iPhone Anda dengan mudah</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-mobile-alt text-6xl text-blue-200"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Rental History -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-history text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Riwayat Sewa iPhone</h2>
                                <p class="text-sm text-gray-500">Kelola dan pantau status rental Anda</p>
                            </div>
                        </div>
                        @if(isset($riwayat) && $riwayat->count())
                            <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $riwayat->count() }} Total Rental
                            </div>
                        @endif
                    </div>

                    @if(isset($riwayat) && $riwayat->count())
                        <div class="space-y-4">
                            @foreach($riwayat as $pesanan)
                                @php
                                    // Inisialisasi default agar tidak error undefined variable
                                    $status = '';
                                    $badgeColor = '';
                                    $badgeTextColor = '';

                                    $isLunas = $pesanan->pembayaran && $pesanan->pembayaran->status == 'Lunas';
                                    $isDiambil = $pesanan->pengambilan != null;
                                    $isDikembalikan = $pesanan->pengembalian != null;
                                    $denda = $isDikembalikan ? ($pesanan->pengembalian->denda ?? 0) : 0;
                                    $isSelesaiPengembalian = $isDikembalikan 
                                        && isset($pesanan->pengembalian->status_pengembalian) 
                                        && $pesanan->pengembalian->status_pengembalian === 'selesai';
                                    $lunasDenda = $isDikembalikan ? (
                                        ($pesanan->pengembalian->lunas_denda ?? false)
                                        || (strtolower($pesanan->pengembalian->status_bayar ?? '') === 'lunas')
                                    ) : false;
                                    $tanggalSewa = \Carbon\Carbon::parse($pesanan->tanggal_sewa);
                                    $tanggalKembali = \Carbon\Carbon::parse($pesanan->tanggal_kembali);
                                    $durasi = $tanggalKembali->diffInDays($tanggalSewa) + 1;
                                    $terlambat = 0;
                                    if ($isDikembalikan && !empty($pesanan->pengembalian->tanggal_kembali_real)) {
                                        $tglKembaliReal = \Carbon\Carbon::parse($pesanan->pengembalian->tanggal_kembali_real);
                                        $terlambat = $tglKembaliReal->gt($tanggalKembali) ? $tglKembaliReal->diffInDays($tanggalKembali) : 0;
                                    }
                                    $step = 1;
                                    if ($isLunas) $step = 2;
                                    if ($isDiambil) $step = 3;
                                    if ($isDikembalikan) $step = 4;
                                    // Logic status & badge
                                    if (!$isLunas) {
                                        $status = 'Menunggu Pembayaran';
                                        $badgeColor = 'bg-yellow-100';
                                        $badgeTextColor = 'text-yellow-800';
                                    } elseif ($isLunas && !$isDiambil) {
                                        $status = 'Siap Diambil';
                                        $badgeColor = 'bg-blue-100';
                                        $badgeTextColor = 'text-blue-800';
                                    } elseif ($isLunas && $isDiambil && !$isDikembalikan) {
                                        $status = 'Sedang Aktif';
                                        $badgeColor = 'bg-orange-100';
                                        $badgeTextColor = 'text-orange-800';
                                    } elseif ($isDikembalikan && !$isSelesaiPengembalian && $denda == 0) {
                                        $status = 'Menunggu Konfirmasi Pengembalian';
                                        $badgeColor = 'bg-blue-100';
                                        $badgeTextColor = 'text-blue-800';
                                    } elseif ($isDikembalikan && !$isSelesaiPengembalian && $denda > 0 && !$lunasDenda) {
                                        $status = 'Denda Belum Dibayar';
                                        $badgeColor = 'bg-red-100';
                                        $badgeTextColor = 'text-red-800';
                                    } elseif ($isDikembalikan && !$isSelesaiPengembalian && $denda > 0 && $lunasDenda) {
                                        // Sudah lunas denda, tapi belum konfirmasi pengembalian
                                        $status = 'Menunggu Konfirmasi Pengembalian';
                                        $badgeColor = 'bg-blue-100';
                                        $badgeTextColor = 'text-blue-800';
                                    } elseif ($isSelesaiPengembalian && $denda > 0 && !$lunasDenda) {
                                        $status = 'Denda Belum Dibayar';
                                        $badgeColor = 'bg-red-100';
                                        $badgeTextColor = 'text-red-800';
                                    } elseif ($isSelesaiPengembalian && $denda > 0 && $lunasDenda) {
                                        $status = 'Selesai';
                                        $badgeColor = 'bg-green-100';
                                        $badgeTextColor = 'text-green-800';
                                    } elseif ($isSelesaiPengembalian && $denda == 0) {
                                        $status = 'Selesai';
                                        $badgeColor = 'bg-green-100';
                                        $badgeTextColor = 'text-green-800';
                                    }
                                    $steps = [
                                        ['label' => 'Pembayaran', 'icon' => 'fa-money-bill-wave'],
                                        ['label' => 'Pengambilan', 'icon' => 'fa-hand-holding-heart'],
                                        ['label' => 'Penggunaan',  'icon' => 'fa-mobile-alt'],
                                        ['label' => 'Pengembalian', 'icon' => 'fa-undo'],
                                    ];
                                    // Tombol aksi
                                    $btn = null;
                                    $swalMsg = '';
                                    if (
                                        $pesanan->pembayaran &&
                                        $pesanan->pembayaran->metode_bayar === 'Tunai' &&
                                        $pesanan->pembayaran->status === 'Belum Bayar' &&
                                        !$isDiambil
                                    ) {
                                        $btn = [
                                            'label' => 'Bayar dan Ambil iPhone',
                                            'url' => route('konfirmasi.pengambilan', $pesanan->id_pemesanan),
                                            'icon' => 'fa-hand-holding-heart',
                                            'class' => 'bg-blue-600 hover:bg-blue-700 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'Lanjutkan pembayaran tunai pada saat pengambilan. Silakan datang ke lokasi pada tanggal yang telah disepakati.';
                                    }
                                    elseif (!$pesanan->pembayaran || $pesanan->pembayaran->status == 'Belum Bayar') {
                                        $btn = [
                                            'label' => 'Bayar Sekarang',
                                            'url' => route('pembayaran.show', $pesanan->id_pemesanan),
                                            'icon' => 'fa-money-bill-wave',
                                            'class' => 'bg-yellow-500 hover:bg-yellow-600 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'Lanjutkan ke halaman pembayaran untuk melakukan pembayaran.';
                                    }
                                    elseif ($isLunas && !$isDiambil) {
                                        $btn = [
                                            'label' => 'Ambil iPhone',
                                            'url' => route('konfirmasi.pengambilan', $pesanan->id_pemesanan),
                                            'icon' => 'fa-hand-holding-heart',
                                            'class' => 'bg-blue-600 hover:bg-blue-700 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'Lanjutkan Ambil iPhone. Silakan datang ke lokasi untuk mengambil iPhone anda pada tanggal yang telah disepakati.';
                                    }
                                    elseif ($isDiambil && !$isDikembalikan) {
                                        $btn = [
                                            'label' => 'Kembalikan iPhone',
                                            'url' => route('konfirmasi.pengembalian', $pesanan->id_pemesanan),
                                            'icon' => 'fa-undo',
                                            'class' => 'bg-orange-500 hover:bg-orange-600 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'Kembalikanlah iPhone tepat waktu ke petugas iRentalKita pada tanggal yang telah disepakati.';
                                    }
                                    // Button konfirmasi pengembalian untuk tanpa denda atau sudah lunas denda (belum konfirmasi pengembalian)
                                    elseif ($isDikembalikan && !$isSelesaiPengembalian && ($denda == 0 || $lunasDenda)) {
                                        $btn = [
                                            'label' => 'Konfirmasi dan Kembalikan iPhone',
                                            'url' => route('konfirmasi.pengembalian', $pesanan->id_pemesanan),
                                            'icon' => 'fa-undo',
                                            'class' => 'bg-blue-500 hover:bg-blue-600 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'iPhone telah diperiksa oleh petugas, lakukanlah konfirmasi pengembalian';
                                    }
                                    // Button bayar denda (ada denda, belum lunas dan belum konfirmasi pengembalian)
                                    elseif ($isDikembalikan && !$isSelesaiPengembalian && $denda > 0 && !$lunasDenda) {
                                        $btn = [
                                            'label' => 'Bayar Denda',
                                            'url' => route('konfirmasi.pengembalian', $pesanan->id_pemesanan),
                                            'icon' => 'fa-exclamation-triangle',
                                            'class' => 'bg-red-600 hover:bg-red-700 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'Anda dinyatakan denda. Mohon bayar dendanya dengan segera untuk mengambil kembali jaminan KTP anda.';
                                    }
                                    elseif ($isSelesaiPengembalian && $denda > 0 && !$lunasDenda) {
                                        $btn = [
                                            'label' => 'Bayar Denda',
                                            'url' => route('konfirmasi.pengembalian', $pesanan->id_pemesanan),
                                            'icon' => 'fa-exclamation-triangle',
                                            'class' => 'bg-red-600 hover:bg-red-700 text-white transition-colors duration-300'
                                        ];
                                        $swalMsg = 'Anda dinyatakan denda. Mohon bayar dendanya dengan segera untuk mengambil kembali jaminan KTP anda.';
                                    }
                                @endphp

                                <!-- Rental Card -->
                                <div class="relative overflow-hidden rounded-xl border-2
                                    @if($step == 4 && $status == 'Selesai') border-green-200 bg-gradient-to-br from-green-50 to-green-100
                                    @elseif($status == 'Denda Belum Dibayar') border-red-200 bg-gradient-to-br from-red-50 to-red-100
                                    @elseif($step == 3) border-orange-200 bg-gradient-to-br from-orange-50 to-orange-100
                                    @elseif($step == 2) border-blue-200 bg-gradient-to-br from-blue-50 to-blue-100
                                    @elseif($status == 'Menunggu Konfirmasi Pengembalian') border-blue-200 bg-gradient-to-br from-blue-50 to-blue-100
                                    @else border-yellow-200 bg-gradient-to-br from-yellow-50 to-yellow-100
                                    @endif
                                    transition-all duration-300">
                                    <!-- Status Badge -->
                                    <div class="absolute top-3 right-3 z-10">
                                        <div class="flex items-center {{ $badgeColor }} {{ $badgeTextColor }} px-2.5 py-1 rounded-full text-xs font-semibold shadow-sm">
                                            <div class="w-1.5 h-1.5 rounded-full mr-1.5
                                                @if($status == 'Menunggu Pembayaran') bg-yellow-700
                                                @elseif($status == 'Siap Diambil') bg-blue-600
                                                @elseif($status == 'Sedang Aktif') bg-orange-600
                                                @elseif($status == 'Denda Belum Dibayar') bg-red-700
                                                @else bg-green-500
                                                @endif
                                            "></div>
                                            {{ $status }}
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <div class="flex flex-col lg:flex-row gap-4">
                                            <!-- iPhone Image Section -->
                                            <div class="flex-shrink-0">
                                                <div class="relative">
                                                    <div class="w-28 h-28 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center">
                                                        @if(!empty($pesanan->iphone->gambar))
                                                            <img src="{{ $pesanan->iphone->gambar }}" class="w-28 h-28 object-contain rounded-xl border-2 border-gray-300" alt="iPhone">
                                                        @else
                                                            <i class="fas fa-mobile-alt text-2xl text-gray-400"></i>
                                                        @endif
                                                    </div>
                                                    <div class="absolute -bottom-1 -right-1 w-7 h-7 rounded-full flex items-center justify-center shadow-lg
                                                        @if($status == 'Menunggu Pembayaran') bg-yellow-500
                                                        @elseif($status == 'Siap Diambil') bg-blue-500
                                                        @elseif($status == 'Sedang Aktif') bg-orange-500
                                                        @elseif($status == 'Denda Belum Dibayar') bg-red-500
                                                        @else bg-green-500
                                                        @endif
                                                    ">
                                                        <i class="fas 
                                                            @if($status == 'Menunggu Pembayaran') fa-clock
                                                            @elseif($status == 'Siap Diambil') fa-hand-holding
                                                            @elseif($status == 'Sedang Aktif') fa-mobile-alt
                                                            @elseif($status == 'Denda Belum Dibayar') fa-exclamation-triangle
                                                            @else fa-check
                                                            @endif
                                                            text-white text-xs"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1 space-y-3">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-900 mb-0.5">{{ $pesanan->iphone->tipe_iphone ?? '-' }}</h3>
                                                    <p class="text-sm text-gray-600">Warna : {{ $pesanan->iphone->warna ?? 'Warna tidak tersedia' }} </p>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                    <div class="bg-white/70 backdrop-blur-sm rounded-lg p-3 border border-white/50 shadow-sm">
                                                        <div class="flex items-center mb-1.5">
                                                            <div class="w-7 h-7 bg-blue-100 rounded-md flex items-center justify-center mr-2">
                                                                <i class="fas fa-calendar-alt text-blue-600 text-xs"></i>
                                                            </div>
                                                            <h4 class="font-semibold text-gray-900 text-sm">Periode Sewa</h4>
                                                        </div>
                                                        <p class="text-xs text-gray-600 mb-0.5">{{ \Carbon\Carbon::parse($pesanan->tanggal_sewa)->format('d M Y') }} - {{ \Carbon\Carbon::parse($pesanan->tanggal_kembali)->format('d M Y') }}</p>
                                                        <p class="text-xs text-gray-500">
                                                            {{ $durasi }} hari
                                                            @if($terlambat > 0)
                                                                <span class="text-red-600 font-medium">+ {{ $terlambat }} hari terlambat</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="bg-white/70 backdrop-blur-sm rounded-lg p-3 border border-white/50 shadow-sm">
                                                        <div class="flex items-center mb-1.5">
                                                            <div class="w-7 h-7 bg-green-100 rounded-md flex items-center justify-center mr-2">
                                                                <i class="fas fa-money-bill-wave text-green-600 text-xs"></i>
                                                            </div>
                                                            <h4 class="font-semibold text-gray-900 text-sm">Total Pembayaran</h4>
                                                        </div>
                                                        <p class="text-base font-bold text-gray-900">Rp {{ number_format($pesanan->pembayaran->total_bayar ?? 0) }}</p>
                                                        @if($denda > 0)
                                                            <p class="text-xs text-red-600 font-medium">+ Denda Rp {{ number_format($denda) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="bg-white/70 backdrop-blur-sm rounded-lg p-3 border border-white/50 shadow-sm">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h4 class="font-semibold text-gray-900 text-sm">Progress Rental</h4>
                                                        <span class="text-xs text-gray-600">
                                                            @if($step < 4)
                                                                Step {{ $step }}/4
                                                            @else
                                                                {{ $status == 'Selesai' ? 'Selesai' : $status }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        @foreach($steps as $i => $s)
                                                            <div class="flex flex-col items-center flex-1">
                                                                <div class="w-8 h-8 rounded-full flex items-center justify-center mb-1.5 transition-all duration-300
                                                                    @if($i+1 < $step)
                                                                        bg-green-500 shadow-lg
                                                                    @elseif($i+1 == $step)
                                                                        @if($step == 4 && $status == 'Selesai')
                                                                            bg-green-500 shadow-lg
                                                                        @elseif($step == 4 && $status == 'Denda Belum Dibayar')
                                                                            bg-red-500 shadow-lg
                                                                        @elseif($step == 4 && $status == 'Menunggu Konfirmasi Pengembalian')
                                                                            bg-blue-500 shadow-lg
                                                                        @else
                                                                            bg-blue-500 shadow-lg
                                                                        @endif
                                                                    @else
                                                                        bg-gray-300
                                                                    @endif
                                                                ">
                                                                    <i class="fas {{ $s['icon'] }} text-xs
                                                                        @if($i+1 <= $step)
                                                                            text-white
                                                                        @else
                                                                            text-gray-500
                                                                        @endif
                                                                    "></i>
                                                                </div>
                                                                <span class="text-xs text-center font-medium
                                                                    @if($i+1 < $step)
                                                                        text-green-600
                                                                    @elseif($i+1 == $step && $status == 'Selesai')
                                                                        text-green-600
                                                                    @elseif($i+1 == $step && $status == 'Denda Belum Dibayar')
                                                                        text-red-600
                                                                    @elseif($i+1 == $step && $status == 'Menunggu Konfirmasi Pengembalian')
                                                                        text-blue-600
                                                                    @elseif($i+1 == $step)
                                                                        text-blue-600
                                                                    @else
                                                                        text-gray-500
                                                                    @endif
                                                                ">{{ $s['label'] }}</span>
                                                            </div>
                                                            @if($i < count($steps)-1)
                                                                <div class="flex-1 h-0.5 mx-1.5 rounded-full
                                                                    @if($i+2 <= $step)
                                                                        @if($i+2 == 4 && $status == 'Selesai')
                                                                            bg-green-500
                                                                        @elseif($i+2 == 4 && $status == 'Denda Belum Dibayar')
                                                                            bg-red-500
                                                                        @elseif($i+2 == 4 && $status == 'Menunggu Konfirmasi Pengembalian')
                                                                            bg-blue-500
                                                                        @else
                                                                            bg-green-500
                                                                        @endif
                                                                    @elseif($i+1 == $step)
                                                                        bg-blue-500
                                                                    @else
                                                                        bg-gray-300
                                                                    @endif
                                                                "></div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                {{-- Status Messages & ACTION BUTTON --}}
                                                @if($isSelesaiPengembalian && $denda == 0)
                                                    <div class="bg-green-100 border-l-4 border-green-500 rounded-lg p-3">
                                                        <div class="flex items-center">
                                                            <div class="w-7 h-7 bg-green-500 rounded-full flex items-center justify-center mr-2">
                                                                <i class="fas fa-check text-white text-xs"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="font-semibold text-green-800 text-sm">Rental Selesai</h5>
                                                                <p class="text-xs text-green-700">iPhone telah dikembalikan tanpa denda</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($isSelesaiPengembalian && $denda > 0 && $lunasDenda)
                                                    <div class="bg-green-100 border-l-4 border-green-500 rounded-lg p-3">
                                                        <div class="flex items-center">
                                                            <div class="w-7 h-7 bg-green-500 rounded-full flex items-center justify-center mr-2">
                                                                <i class="fas fa-check text-white text-xs"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="font-semibold text-green-800 text-sm">Rental Selesai</h5>
                                                                <p class="text-xs text-green-700">Denda telah dibayar lunas</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- Button only for konfirmasi pengembalian / bayar denda --}}
                                                @if($btn)
                                                    <div class="pt-1">
                                                        <button type="button"
                                                            class="inline-flex items-center px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300 {{ $btn['class'] }} btn-konfirmasi-aksi"
                                                            data-url="{{ $btn['url'] }}"
                                                            data-label="{{ $btn['label'] }}"
                                                            data-swal-message="{{ trim($swalMsg) }}">
                                                            <i class="fas {{ $btn['icon'] }} mr-2"></i>
                                                            {{ $btn['label'] }}
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-28 h-28 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                                <i class="fas fa-mobile-alt text-4xl text-blue-500"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada iPhone yang Dipesan</h3>
                            <p class="text-gray-600 mb-6 max-w-sm mx-auto">Anda belum memiliki riwayat sewa iPhone. Mulai sewa iPhone pertama Anda sekarang dan nikmati pengalaman terbaik!</p>
                            <a href="{{ route('daftar-iphone') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 transition-colors duration-300 py-3.5 px-7 rounded-xl font-semibold text-white">
                                <i class="fas fa-plus mr-2.5 text-white"></i>
                                Sewa iPhone Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column - Profile -->
            <div>
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Profile Saya</h2>
                    <form method="POST" action="{{ route('penyewa.update-profile') }}">
                        @csrf
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-white">
                                    {{ strtoupper(substr(Auth::guard('penyewa')->user()->nama, 0, 1)) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ Auth::guard('penyewa')->user()->nama }}</h3>
                            <p class="text-sm text-gray-600">
                                Daftar pada {{ \Carbon\Carbon::parse(Auth::guard('penyewa')->user()->tanggal_daftar)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        <div class="space-y-4 mb-6">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ Auth::guard('penyewa')->user()->nama }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" required>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ Auth::guard('penyewa')->user()->email }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" required>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <input type="tel" name="no_hp" value="{{ Auth::guard('penyewa')->user()->no_hp }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" required>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea name="alamat" rows="3" class="w-full p-2 border border-gray-300 rounded-md text-sm" required>{{ Auth::guard('penyewa')->user()->alamat }}</textarea>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. KTP</label>
                                <input type="text" name="no_ktp" value="{{ Auth::guard('penyewa')->user()->no_ktp }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-edit mr-2"></i>
                            Update Profile
                        </button>
                    </form>
                    <form id="logoutForm" method="POST" action="{{ route('penyewa.logout') }}">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center mt-3">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    confirmButtonText: 'Oke'
});
</script>
@endif

@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: 'Data gagal diubah, mohon cek kembali isian Anda!',
    confirmButtonText: 'Oke'
});
</script>
@endif

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Yakin ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logoutForm').submit();
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-konfirmasi-aksi').forEach(function(btn){
        btn.addEventListener('click', function(e){
            let url = btn.getAttribute('data-url');
            let label = btn.getAttribute('data-label');
            let pesan = btn.getAttribute('data-swal-message') || 'Lanjutkan ke langkah berikutnya?';

            Swal.fire({
                icon: 'question',
                title: label,
                text: pesan.trim(),
                showCancelButton: true,
                confirmButtonText: 'Oke',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
});
</script>
@endpush