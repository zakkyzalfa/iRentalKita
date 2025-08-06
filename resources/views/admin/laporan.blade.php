@extends('layouts.admin')

@section('title', 'Laporan Bulanan')

@section('content')
<!-- Main Content -->
<section class="py-8 bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Laporan Bulanan</h1>
                    <p class="text-green-100 text-lg">Analisis performa dan keuangan rental iPhone</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-chart-line text-6xl text-green-200"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Period Selector -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
            <form method="GET" action="">
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <label class="text-sm font-medium text-gray-700">Bulan:</label>
                        <select name="bulan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            @foreach($availableMonths as $bulan => $label)
                                <option value="{{ $bulan }}" {{ $bulan == $selectedMonth ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center">
                            <i class="fas fa-search mr-2"></i>
                            Tampilkan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border-2 border-blue-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Transaksi Bulan Ini</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalTransaksi }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-handshake text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border-2 border-green-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                        <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalPendapatan) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border-2 border-red-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pendapatan Denda</p>
                        <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalDenda) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border-2 border-purple-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Jumlah Penyewa Baru</p>
                        <p class="text-3xl font-bold text-purple-600">{{ $totalPenyewaBaru }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection