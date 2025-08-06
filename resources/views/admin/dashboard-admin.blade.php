@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <!-- Welcome Header -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Dashboard Admin</h1>
                    <p class="text-red-100 text-lg">Kelola sistem rental iPhone dengan mudah</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-cogs text-6xl text-red-200"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total iPhone -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-blue-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-800">Total iPhone</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalIphone }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- iPhone Tersedia -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-green-500 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-800">iPhone Tersedia</p>
                        <p class="text-3xl font-bold text-green-600">{{ $tersedia }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- iPhone Disewa -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-400 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-800">iPhone Disewa</p>
                        <p class="text-3xl font-bold text-orange-600">{{ $disewa }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- Total Penyewa -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-purple-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-800">Total Penyewa</p>
                        <p class="text-3xl font-bold text-purple-600">{{ $penyewaCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Enhanced Rental Cards -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-list-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Rental Aktif & Riwayat</h2>
                                <p class="text-sm text-gray-500">Kelola semua transaksi rental iPhone</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ count($activeRentals) }} Total Rental
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-6" id="activeRentals">
                        @forelse($activeRentals as $rental)
                            @php
                                $sudahBayar = $rental->pembayaran && $rental->pembayaran->status === 'Lunas';
                                $belumBayar = !$rental->pembayaran || $rental->pembayaran->status === 'Belum Bayar';
                                $sudahDiambil = $rental->pengambilan != null;
                                $sudahDikembalikan = $rental->pengembalian != null;

                                $adaDenda = $sudahDikembalikan && $rental->pengembalian->denda > 0;
                                $dendaBelumDibayar = $adaDenda && $rental->pengembalian->status_bayar != 'lunas';

                                // Apakah pengembalian sudah dikonfirmasi oleh penyewa?
                                $isKonfirmasiSelesai = $sudahDikembalikan && isset($rental->pengembalian->status_pengembalian) && $rental->pengembalian->status_pengembalian === 'selesai';

                                // Pemeriksaan selesai: sudah ada pengembalian, tidak ada denda atau denda sudah lunas, dan BELUM konfirmasi pengembalian
                                $isPemeriksaanSelesai = $sudahDikembalikan 
                                    && !$isKonfirmasiSelesai
                                    && (
                                        ($rental->pengembalian->denda == 0)
                                        || ($adaDenda && $rental->pengembalian->status_bayar == 'lunas')
                                    );

                                // Enhanced styling based on status
                                $cardStyle = '';
                                $statusConfig = [];
                                
                                if ($belumBayar) {
                                    $cardStyle = 'bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-l-yellow-400';
                                    $statusConfig = [
                                        'label' => 'Menunggu Pembayaran',
                                        'icon' => 'fa-clock',
                                        'color' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'iconBg' => 'bg-yellow-100 text-yellow-600'
                                    ];
                                } elseif (!$sudahDiambil) {
                                    $cardStyle = 'bg-gradient-to-r from-gray-50 to-slate-50 border-l-4 border-l-gray-400';
                                    $statusConfig = [
                                        'label' => 'Siap Diambil',
                                        'icon' => 'fa-hand-holding',
                                        'color' => 'bg-gray-100 text-gray-800 border-gray-200',
                                        'iconBg' => 'bg-gray-100 text-gray-600'
                                    ];
                                } elseif ($isKonfirmasiSelesai) {
                                    $cardStyle = 'bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-l-green-400';
                                    $statusConfig = [
                                        'label' => 'Sewa Selesai',
                                        'icon' => 'fa-check-circle',
                                        'color' => 'bg-green-100 text-green-800 border-green-200',
                                        'iconBg' => 'bg-green-100 text-green-600'
                                    ];
                                } elseif ($dendaBelumDibayar) {
                                    $cardStyle = 'bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-l-red-400';
                                    $statusConfig = [
                                        'label' => 'Denda Belum Dibayar',
                                        'icon' => 'fa-exclamation-triangle',
                                        'color' => 'bg-red-100 text-red-800 border-red-200',
                                        'iconBg' => 'bg-red-100 text-red-600'
                                    ];
                                } elseif ($isPemeriksaanSelesai) {
                                    $cardStyle = 'bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-l-blue-400';
                                    $statusConfig = [
                                        'label' => 'Pemeriksaan Selesai',
                                        'icon' => 'fa-clipboard-check',
                                        'color' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'iconBg' => 'bg-blue-100 text-blue-600'
                                    ];
                                } elseif ($sudahDiambil && !$sudahDikembalikan) {
                                    $cardStyle = 'bg-gradient-to-r from-orange-50 to-amber-50 border-l-4 border-l-orange-400';
                                    $statusConfig = [
                                        'label' => 'Sedang Disewa',
                                        'icon' => 'fa-mobile-alt',
                                        'color' => 'bg-orange-100 text-orange-800 border-orange-200',
                                        'iconBg' => 'bg-orange-100 text-orange-600'
                                    ];
                                }

                                $showHapus = $isKonfirmasiSelesai;
                                $showPeriksa = $sudahDiambil && !$sudahDikembalikan;

                                // Data lengkap untuk modal detail (JSON encode)
                                $durasi = (!empty($rental->tanggal_sewa) && !empty($rental->tanggal_kembali))
                                    ? (\Carbon\Carbon::parse($rental->tanggal_kembali)->diffInDays(\Carbon\Carbon::parse($rental->tanggal_sewa)) + 1)
                                    : '-';
                                    
                                $rentalData = [
                                    'penyewa' => [
                                        'nama' => $rental->penyewa->nama ?? '-',
                                        'email' => $rental->penyewa->email ?? '-',
                                        'no_hp' => $rental->penyewa->no_hp ?? '-',
                                        'no_ktp' => $rental->penyewa->no_ktp ?? '-',
                                        'alamat' => $rental->penyewa->alamat ?? '-',
                                    ],
                                    'iphone' => [
                                        'gambar' => $rental->iphone->gambar ?? '',
                                        'tipe_iphone' => $rental->iphone->tipe_iphone ?? '-',
                                        'imei' => $rental->iphone->imei ?? '-',
                                        'harga_per_hari' => $rental->iphone->harga_per_hari ?? 0,
                                        'warna' => $rental->iphone->warna ?? '-',
                                    ],
                                    'pemesanan' => [
                                        'tanggal_sewa' => $rental->tanggal_sewa ? \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') : '-',
                                        'tanggal_kembali' => $rental->tanggal_kembali ? \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') : '-',
                                        'durasi' => $durasi,
                                        'status' => $statusConfig['label'],
                                    ],
                                    'pembayaran' => [
                                        'metode_bayar' => $rental->pembayaran->metode_bayar ?? '-',
                                        'status' => $rental->pembayaran->status ?? '-',
                                        'total_bayar' => $rental->pembayaran->total_bayar ?? 0,
                                    ],
                                    'pengambilan' => $rental->pengambilan ? [
                                        'tanggal_ambil' => \Carbon\Carbon::parse($rental->pengambilan->tanggal_ambil)->format('d M Y H:i'),
                                        'status' => 'Sudah Diambil'
                                    ] : [
                                        'tanggal_ambil' => '-',
                                        'status' => 'Belum Diambil'
                                    ],
                                    'pengembalian' => $rental->pengembalian ? [
                                        'tanggal_kembali_real' => \Carbon\Carbon::parse($rental->pengembalian->tanggal_kembali_real)->format('d M Y H:i'),
                                        'status_pengembalian' => $rental->pengembalian->status_pengembalian ?? '-',
                                        'denda' => $rental->pengembalian->denda ?? 0,
                                        'status_bayar' => $rental->pengembalian->status_bayar ?? '-',
                                        'pemeriksaan' => $rental->pengembalian->kondisi_kembali ?? null,
                                    ] : null,
                                ];
                            @endphp

                            <!-- Enhanced Rental Card -->
                            <div class="relative {{ $cardStyle }} rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <!-- Status Badge (Top Right) -->
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $statusConfig['color'] }}">
                                        <i class="fas {{ $statusConfig['icon'] }} mr-1.5"></i>
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </div>

                                <!-- Main Content -->
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <!-- iPhone Image & Status Icon -->
                                    <div class="flex-shrink-0 relative">
                                        <div class="w-24 h-24 lg:w-32 lg:h-32 bg-white rounded-xl shadow-sm border-2 border-gray-100 flex items-center justify-center overflow-hidden">
                                            @if(!empty($rental->iphone->gambar))
                                                <img src="{{ $rental->iphone->gambar }}" class="w-full h-full object-contain p-2" alt="iPhone">
                                            @else
                                                <i class="fas fa-mobile-alt text-3xl text-gray-400"></i>
                                            @endif
                                        </div>
                                        <!-- Status Icon Overlay -->
                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 {{ $statusConfig['iconBg'] }} rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                                            <i class="fas {{ $statusConfig['icon'] }} text-sm"></i>
                                        </div>
                                    </div>

                                    <!-- Rental Information -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Header Info -->
                                        <div class="mb-4">
                                            <div class="flex items-start justify-between mb-2">
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $rental->iphone->tipe_iphone ?? '-' }}</h3>
                                                    <div class="flex items-center space-x-2 mt-1">
                                                        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                                            <span class="text-xs font-bold text-blue-600">{{ substr($rental->penyewa->nama ?? 'U', 0, 1) }}</span>
                                                        </div>
                                                        <span class="text-sm font-medium text-gray-700">{{ $rental->penyewa->nama ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Details Grid -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                            <!-- Rental Period -->
                                            <div class="bg-white bg-opacity-60 rounded-lg p-3 border border-gray-200">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <i class="fas fa-calendar-alt text-gray-500 text-sm"></i>
                                                    <span class="text-xs font-medium text-gray-600 uppercase tracking-wide">Periode Sewa</span>
                                                </div>
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($rental->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-600">{{ $durasi }} hari</div>
                                            </div>

                                            <!-- Payment Info -->
                                            <div class="bg-white bg-opacity-60 rounded-lg p-3 border border-gray-200">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <i class="fas fa-money-bill-wave text-gray-500 text-sm"></i>
                                                    <span class="text-xs font-medium text-gray-600 uppercase tracking-wide">Total Bayar</span>
                                                </div>
                                                <div class="text-sm font-bold text-green-600">
                                                    Rp {{ number_format($rental->pembayaran->total_bayar ?? 0) }}
                                                </div>
                                                <div class="text-xs text-gray-600">{{ $rental->pembayaran->metode_bayar ?? '-' }}</div>
                                            </div>
                                        </div>

                                        <!-- Denda Alert (if applicable) -->
                                        @if($adaDenda && $dendaBelumDibayar)
                                            <div class="bg-red-100 border border-red-200 rounded-lg p-3 mb-4">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                                                    <span class="text-sm font-semibold text-red-800">Denda: Rp {{ number_format($rental->pengembalian->denda) }}</span>
                                                    <span class="text-xs bg-red-200 text-red-800 px-2 py-1 rounded-full">Belum Dibayar</span>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <button type="button"
                                                class="flex-1 bg-white hover:bg-gray-50 text-gray-700 py-2.5 px-4 rounded-lg text-sm font-medium border border-gray-300 transition-colors flex items-center justify-center"
                                                data-detail='@json($rentalData)'
                                                onclick="showDetailRentalFromButton(this)">
                                                <i class="fas fa-eye mr-2"></i>
                                                Lihat Detail
                                            </button>

                                            @if($showHapus)
                                            <form action="{{ route('admin.hapus-pemesanan', $rental->id_pemesanan) }}" method="POST" class="form-hapus-riwayat flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Hapus Riwayat
                                                </button>
                                            </form>
                                            @endif

                                            @if($showPeriksa)
                                                <a href="{{ route('admin.proses-pengembalian', $rental->id_pemesanan) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors text-center flex items-center justify-center">
                                                    <i class="fas fa-search mr-2"></i>
                                                    Periksa iPhone
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Empty State -->
                            <div class="text-center py-16">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-inbox text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Rental</h3>
                                <p class="text-gray-500 mb-6">Tidak ada rental aktif atau riwayat saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column - Quick Actions & Stats -->
            <div>
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Lainnya</h2>
                        <div class="space-y-3">
                            <button onclick="goToLaporan()" class="w-full bg-purple-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-purple-700 transition-colors flex items-center justify-center">
                                <i class="fas fa-chart-bar mr-3"></i>
                                Lihat Laporan
                            </button>
                            <button id="logout-btn" class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Log Out
                            </button>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Modal Detail Rental -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white rounded-2xl max-w-6xl w-full max-h-[95vh] overflow-hidden shadow-2xl">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 text-white relative">
                <button onclick="closeModal()" class="absolute top-4 right-6 text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">Detail Rental iPhone</h3>
                        <p class="text-blue-100 text-sm">Informasi lengkap transaksi rental</p>
                    </div>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="overflow-y-auto max-h-[calc(95vh-120px)]">
                <div id="modalContent" class="p-8">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Anda akan keluar dari sesi admin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });

    function showDetailRental(data) {
        // Status badge helper function
        function getStatusBadge(status, type = 'default') {
            const statusClasses = {
                'Lunas': 'bg-green-100 text-green-800 border-green-200',
                'Belum Bayar': 'bg-red-100 text-red-800 border-red-200',
                'Sudah Diambil': 'bg-blue-100 text-blue-800 border-blue-200',
                'Belum Diambil': 'bg-gray-100 text-gray-800 border-gray-200',
                'selesai': 'bg-green-100 text-green-800 border-green-200',
                'diperiksa': 'bg-orange-100 text-orange-800 border-orange-200',
                'lunas': 'bg-green-100 text-green-800 border-green-200',
                'belum': 'bg-red-100 text-red-800 border-red-200'
            };
            
            const className = statusClasses[status] || 'bg-gray-100 text-gray-800 border-gray-200';
            return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border ${className}">${status}</span>`;
        }

        // Avatar generation
        const avatar = `<div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-2xl text-white font-bold shadow-lg">
            ${data.penyewa.nama ? data.penyewa.nama.charAt(0).toUpperCase() : '?'}
        </div>`;

        // iPhone image
        const iphoneImg = data.iphone.gambar
            ? `<img src="${data.iphone.gambar}" class="w-32 h-32 object-contain rounded-xl border-2 border-gray-200 bg-gray-50 p-2" alt="iPhone">`
            : `<div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-xl border-2 border-gray-200">
                <i class="fas fa-mobile-alt text-4xl text-gray-400"></i>
               </div>`;

        // Pemeriksaan details
        let pemeriksaanHtml = '';
        if (data.pengembalian && data.pengembalian.pemeriksaan) {
            const pemeriksaanItems = Object.entries(data.pengembalian.pemeriksaan).map(([key, value]) => {
                const statusColor = value === 'baik' || value === 'normal' || value === 'ada' ? 'text-green-600' : 'text-red-600';
                const icon = value === 'baik' || value === 'normal' || value === 'ada' ? 'fa-check-circle' : 'fa-times-circle';
                return `
                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                        <span class="font-medium text-gray-700 capitalize">${key.replace('_', ' ')}</span>
                        <div class="flex items-center space-x-2">
                            <i class="fas ${icon} ${statusColor}"></i>
                            <span class="font-semibold ${statusColor} capitalize">${value}</span>
                        </div>
                    </div>
                `;
            }).join('');
            
            pemeriksaanHtml = `
                <div class="bg-gray-50 rounded-xl p-4 mt-4">
                    <h5 class="font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-search mr-2 text-blue-600"></i>
                        Hasil Pemeriksaan iPhone
                    </h5>
                    <div class="space-y-2">
                        ${pemeriksaanItems}
                    </div>
                </div>
            `;
        }

        document.getElementById('modalContent').innerHTML = `
            <!-- Customer & iPhone Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Customer Info Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                    <div class="flex items-center space-x-4 mb-4">
                        ${avatar}
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">${data.penyewa.nama}</h4>
                            <p class="text-blue-600 font-medium">${data.penyewa.email}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-phone text-blue-600 text-sm"></i>
                            </div>
                            <span class="text-gray-700">${data.penyewa.no_hp}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-id-card text-blue-600 text-sm"></i>
                            </div>
                            <span class="text-gray-700">${data.penyewa.no_ktp}</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                                <i class="fas fa-map-marker-alt text-blue-600 text-sm"></i>
                            </div>
                            <span class="text-gray-700 leading-relaxed">${data.penyewa.alamat}</span>
                        </div>
                    </div>
                </div>

                <!-- iPhone Info Card -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-200">
                    <div class="flex items-center space-x-4 mb-4">
                        ${iphoneImg}
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">${data.iphone.tipe_iphone}</h4>
                            <div class="space-y-1 mt-2">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-palette text-purple-600 text-sm"></i>
                                    <span class="text-gray-700 font-medium">${data.iphone.warna}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-barcode text-purple-600 text-sm"></i>
                                    <span class="text-gray-700 font-mono text-sm">${data.iphone.imei}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-money-bill-wave text-purple-600 text-sm"></i>
                                    <span class="text-gray-700 font-semibold">Rp ${Number(data.iphone.harga_per_hari).toLocaleString()}/hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Booking Details -->
                <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 shadow-sm">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-check text-green-600"></i>
                        </div>
                        Detail Pemesanan
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Tanggal Mulai</span>
                            <span class="font-semibold text-gray-900">${data.pemesanan.tanggal_sewa}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Tanggal Kembali</span>
                            <span class="font-semibold text-gray-900">${data.pemesanan.tanggal_kembali}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Durasi Sewa</span>
                            <span class="font-semibold text-blue-600">${data.pemesanan.durasi} hari</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-600 font-medium">Status Pemesanan</span>
                            ${getStatusBadge(data.pemesanan.status)}
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 shadow-sm">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-credit-card text-yellow-600"></i>
                        </div>
                        Detail Pembayaran
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Metode Pembayaran</span>
                            <span class="font-semibold text-gray-900">${data.pembayaran.metode_bayar}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Status Pembayaran</span>
                            ${getStatusBadge(data.pembayaran.status)}
                        </div>
                        <div class="flex justify-between items-center py-3 bg-green-50 rounded-lg px-4">
                            <span class="text-gray-600 font-medium">Total Pembayaran</span>
                            <span class="font-bold text-green-600 text-lg">Rp ${Number(data.pembayaran.total_bayar).toLocaleString()}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Process Status -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Pickup Status -->
                <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 shadow-sm">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-hand-holding text-blue-600"></i>
                        </div>
                        Status Pengambilan
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Tanggal Diambil</span>
                            <span class="font-semibold text-gray-900">${data.pengambilan.tanggal_ambil}</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-600 font-medium">Status Pengambilan</span>
                            ${getStatusBadge(data.pengambilan.status)}
                        </div>
                    </div>
                </div>

                <!-- Return Status -->
                <div class="bg-white rounded-2xl p-6 border-2 border-gray-200 shadow-sm">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-undo text-orange-600"></i>
                        </div>
                        Status Pengembalian
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Tanggal Dikembalikan</span>
                            <span class="font-semibold text-gray-900">${data.pengembalian ? data.pengembalian.tanggal_kembali_real : '-'}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Status Pengembalian</span>
                            ${data.pengembalian ? getStatusBadge(data.pengembalian.status_pengembalian) : '<span class="text-gray-400">-</span>'}
                        </div>
                        ${data.pengembalian && data.pengembalian.denda > 0 ? `
                        <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-red-700 font-medium flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Denda
                                </span>
                                <span class="font-bold text-red-600 text-lg">Rp ${Number(data.pengembalian.denda).toLocaleString()}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-red-700 font-medium">Status Bayar Denda</span>
                                ${getStatusBadge(data.pengembalian.status_bayar)}
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    ${pemeriksaanHtml}
                </div>
            </div>
        `;
        
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('detailModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModal').classList.remove('flex');
    }

    function showDetailRentalFromButton(btn) {
        const data = JSON.parse(btn.getAttribute('data-detail'));
        showDetailRental(data);
    }

    function goToLaporan() {
        window.location.href = '/admin/laporan';
    }
    
    function goToSemuaRental() {
        window.location.href = '/admin/rental';
    }

    // Close modal when clicking outside
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('detailModal').classList.contains('hidden')) {
            closeModal();
        }
    });

    document.querySelectorAll('.form-hapus-riwayat').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Riwayat Rental?',
                text: "Apakah anda yakin ingin menghapus riwayat pemesanan ini? Data tidak bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
