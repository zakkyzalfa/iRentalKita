@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
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

        <!-- Period Selector - Simplified -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <label class="text-sm font-medium text-gray-700">Bulan:</label>
                        <select id="monthSelect" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="2025-01">Januari 2025</option>
                            <option value="2024-12">Desember 2024</option>
                            <option value="2024-11">November 2024</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-3">
                        <button onclick="exportReport()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards - Only 4 cards -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Transaksi Bulan Ini</p>
                            <p class="text-3xl font-bold text-blue-600" id="totalTransactions">89</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-handshake text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                            <p class="text-3xl font-bold text-green-600" id="totalRevenue">Rp 12.5M</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Denda</p>
                            <p class="text-3xl font-bold text-red-600" id="totalPenalty">Rp 700K</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Jumlah Penyewa</p>
                            <p class="text-3xl font-bold text-purple-600" id="totalCustomers">156</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-purple-600 text-xl"></i>
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
        // Export function
        function exportReport() {
            const selectedMonth = document.getElementById('monthSelect').options[document.getElementById('monthSelect').selectedIndex].text;
            alert(`Laporan ${selectedMonth} akan diekspor!\n\nIsi laporan:\n- Total Transaksi: 89\n- Total Pendapatan: Rp 12.5M\n- Total Denda: Rp 700K\n- Jumlah Penyewa: 156`);
        }

        // Period change handler
        document.getElementById('monthSelect').addEventListener('change', function() {
            const selectedPeriod = this.options[this.selectedIndex].text;
            alert(`Memuat data untuk periode: ${selectedPeriod}`);
            
            // Update data berdasarkan bulan yang dipilih
            updateReportData(this.value);
        });

        // Update report data
        function updateReportData(month) {
            // Sample data update based on selected month
            const data = {
                '2025-01': {
                    transactions: 89,
                    revenue: 'Rp 12.5M',
                    penalty: 'Rp 700K',
                    customers: 156
                },
                '2024-12': {
                    transactions: 76,
                    revenue: 'Rp 10.8M',
                    penalty: 'Rp 450K',
                    customers: 142
                },
                '2024-11': {
                    transactions: 82,
                    revenue: 'Rp 11.2M',
                    penalty: 'Rp 320K',
                    customers: 138
                }
            };
            
            const monthData = data[month] || data['2025-01'];
            
            document.getElementById('totalTransactions').textContent = monthData.transactions;
            document.getElementById('totalRevenue').textContent = monthData.revenue;
            document.getElementById('totalPenalty').textContent = monthData.penalty;
            document.getElementById('totalCustomers').textContent = monthData.customers;
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Laporan Bulanan page loaded');
        });
 </script>
@endpush


