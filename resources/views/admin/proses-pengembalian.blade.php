@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-4xl mx-auto px-8 mb-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-undo text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Proses Pengembalian iPhone</h1>
                <p class="text-lg text-gray-600">Periksa kondisi iPhone dan proses pengembalian</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                
                <!-- Customer & Rental Info - 40% (2 columns) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 sticky top-24">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user mr-3 text-gray-600"></i>
                            Data Penyewa & Rental
                        </h2>

                        <!-- Customer Details -->
                        <div class="space-y-4 mb-6">
                            <div class="text-center mb-4">
                                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <span class="text-xl font-bold text-white">J</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">John Doe</h3>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-900">john.doe@email.com</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="font-medium text-gray-900">+62 812-3456-7890</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">No. KTP:</span>
                                <span class="font-medium text-gray-900">3201234567890123</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tipe iPhone:</span>
                                <span class="font-medium text-gray-900">iPhone 15 Pro Max 256GB</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">IMEI:</span>
                                <span class="font-medium text-gray-900">123456789012345</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Mulai:</span>
                                <span class="font-medium text-gray-900">20 Jan 2025</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tanggal Kembali:</span>
                                <span class="font-medium text-gray-900">25 Jan 2025</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium text-green-600" id="statusKembali">Tepat Waktu</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Sewa:</span>
                                <span class="font-medium text-gray-900">Rp 250.000</span>
                            </div>
                        </div>

                        <!-- Penalty Section (Hidden by default) -->
                        <div id="penaltySection" class="border-t border-red-200 pt-4 mt-4 hidden">
                            <h4 class="font-semibold text-red-800 mb-2">Denda</h4>
                            <div id="penaltyList" class="space-y-2 text-sm">
                                <!-- Penalty items will be added here -->
                            </div>
                            <div class="flex justify-between text-sm font-semibold text-red-600 mt-2 pt-2 border-t border-red-200">
                                <span>Total Denda:</span>
                                <span id="totalPenalty">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Process Steps - 60% (3 columns) -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        
                        <!-- Step 1: Pemeriksaan Kondisi iPhone -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    1
                                </div>
                                Pemeriksaan Kondisi iPhone
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <label class="text-gray-900 font-medium">Layar</label>
                                            <select class="condition-select border border-gray-300 rounded px-2 py-1 text-sm" data-item="layar">
                                                <option value="baik">Baik</option>
                                                <option value="rusak">Rusak</option>
                                            </select>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <label class="text-gray-900 font-medium">Body/Casing</label>
                                            <select class="condition-select border border-gray-300 rounded px-2 py-1 text-sm" data-item="body">
                                                <option value="baik">Baik</option>
                                                <option value="rusak">Rusak</option>
                                            </select>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <label class="text-gray-900 font-medium">Kamera</label>
                                            <select class="condition-select border border-gray-300 rounded px-2 py-1 text-sm" data-item="kamera">
                                                <option value="baik">Baik</option>
                                                <option value="rusak">Rusak</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <label class="text-gray-900 font-medium">Charger</label>
                                            <select class="condition-select border border-gray-300 rounded px-2 py-1 text-sm" data-item="charger">
                                                <option value="ada">Ada</option>
                                                <option value="hilang">Hilang</option>
                                            </select>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <label class="text-gray-900 font-medium">Kemasan</label>
                                            <select class="condition-select border border-gray-300 rounded px-2 py-1 text-sm" data-item="kemasan">
                                                <option value="baik">Baik</option>
                                                <option value="rusak">Rusak</option>
                                            </select>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <label class="text-gray-900 font-medium">Fungsi Umum</label>
                                            <select class="condition-select border border-gray-300 rounded px-2 py-1 text-sm" data-item="fungsi">
                                                <option value="normal">Normal</option>
                                                <option value="bermasalah">Bermasalah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <label for="catatanPemeriksaan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Catatan Pemeriksaan
                                    </label>
                                    <textarea 
                                        id="catatanPemeriksaan" 
                                        rows="3" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Catat kondisi khusus atau kerusakan yang ditemukan..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Perhitungan Denda -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    2
                                </div>
                                Perhitungan Denda (Jika Ada)
                            </h2>
                            
                            <div id="dendaCalculation" class="space-y-4">
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-sm text-gray-600 text-center">
                                        Denda akan dihitung otomatis berdasarkan kondisi iPhone dan keterlambatan
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Pengembalian KTP -->
                        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">
                                    3
                                </div>
                                Pengembalian KTP & Finalisasi
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                        <i class="fas fa-id-card mr-2"></i>
                                        Status KTP Jaminan
                                    </h4>
                                    <p class="text-sm text-blue-700">
                                        KTP penyewa saat ini ditahan sebagai jaminan. 
                                        KTP akan dikembalikan setelah semua denda (jika ada) dibayar.
                                    </p>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="dendaBayar" class="w-5 h-5 text-green-600 rounded focus:ring-green-500" disabled>
                                    <label for="dendaBayar" class="text-gray-900 font-medium">Denda telah dibayar (jika ada)</label>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="ktpKembali" class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                                    <label for="ktpKembali" class="text-gray-900 font-medium">KTP telah dikembalikan kepada penyewa</label>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" id="konfirmasiSelesai" class="w-5 h-5 text-green-600 rounded focus:ring-green-500">
                                    <label for="konfirmasiSelesai" class="text-gray-900 font-medium">Penyewa mengkonfirmasi pengembalian selesai</label>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button onclick="selesaikanPengembalian()" class="flex-1 bg-green-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-green-700 transition-all duration-300 flex items-center justify-center text-lg" id="selesaiBtn" disabled>
                                <i class="fas fa-check mr-3"></i>
                                Selesaikan Pengembalian
                            </button>
                            
                            <button onclick="batalkanProses()" class="flex-1 bg-red-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-red-700 transition-all duration-300 flex items-center justify-center text-lg">
                                <i class="fas fa-times mr-3"></i>
                                Batalkan Proses
                            </button>
                        </div>

                        <!-- Important Notes -->
                        <div class="bg-gray-100 border border-gray-300 rounded-2xl p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-3"></i>
                                Catatan Penting untuk Petugas
                            </h2>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Periksa kondisi iPhone dengan teliti bersama penyewa</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Pastikan semua denda dibayar sebelum mengembalikan KTP</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Dokumentasikan kondisi iPhone dengan foto jika ada kerusakan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-dot-circle mr-2 mt-1 text-xs"></i>
                                    <span>Update status iPhone menjadi "Tersedia" setelah pengembalian selesai</span>
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
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Penalty calculation
        const penaltyRates = {
            layar: 500000,      // Layar rusak
            body: 200000,       // Body rusak
            kamera: 300000,     // Kamera rusak
            charger: 150000,    // Charger hilang
            kemasan: 50000,     // Kemasan rusak
            fungsi: 400000,     // Fungsi bermasalah
            terlambat: 25000    // Per hari terlambat
        };

        function calculatePenalty() {
            let totalPenalty = 0;
            let penaltyItems = [];
            
            // Check each condition
            const conditions = document.querySelectorAll('.condition-select');
            conditions.forEach(select => {
                const item = select.dataset.item;
                const condition = select.value;
                
                if ((item === 'charger' && condition === 'hilang') ||
                    (item !== 'charger' && condition === 'rusak') ||
                    (item === 'fungsi' && condition === 'bermasalah')) {
                    
                    const penalty = penaltyRates[item];
                    totalPenalty += penalty;
                    
                    let description = '';
                    if (item === 'charger' && condition === 'hilang') {
                        description = 'Charger hilang';
                    } else if (item === 'fungsi' && condition === 'bermasalah') {
                        description = 'Fungsi bermasalah';
                    } else {
                        description = `${item.charAt(0).toUpperCase() + item.slice(1)} rusak`;
                    }
                    
                    penaltyItems.push({
                        description: description,
                        amount: penalty
                    });
                }
            });
            
            // Check for late return (example: 1 day late)
            const today = new Date();
            const returnDate = new Date('2025-01-25');
            const daysDiff = Math.ceil((today - returnDate) / (1000 * 60 * 60 * 24));
            
            if (daysDiff > 0) {
                const latePenalty = daysDiff * penaltyRates.terlambat;
                totalPenalty += latePenalty;
                penaltyItems.push({
                    description: `Terlambat ${daysDiff} hari`,
                    amount: latePenalty
                });
                
                // Update status
                document.getElementById('statusKembali').textContent = `Terlambat ${daysDiff} hari`;
                document.getElementById('statusKembali').className = 'font-medium text-red-600';
            }
            
            // Update UI
            updatePenaltyDisplay(penaltyItems, totalPenalty);
            updateDendaCalculation(penaltyItems, totalPenalty);
            
            // Enable/disable denda checkbox
            const dendaBayarCheck = document.getElementById('dendaBayar');
            if (totalPenalty > 0) {
                dendaBayarCheck.disabled = false;
                dendaBayarCheck.required = true;
            } else {
                dendaBayarCheck.disabled = true;
                dendaBayarCheck.checked = true; // Auto-check if no penalty
            }
            
            checkAllRequirements();
        }

        function updatePenaltyDisplay(items, total) {
            const penaltySection = document.getElementById('penaltySection');
            const penaltyList = document.getElementById('penaltyList');
            const totalPenalty = document.getElementById('totalPenalty');
            
            if (total > 0) {
                penaltySection.classList.remove('hidden');
                penaltyList.innerHTML = '';
                
                items.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'flex justify-between';
                    div.innerHTML = `
                        <span>${item.description}:</span>
                        <span>Rp ${item.amount.toLocaleString('id-ID')}</span>
                    `;
                    penaltyList.appendChild(div);
                });
                
                totalPenalty.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            } else {
                penaltySection.classList.add('hidden');
            }
        }

        function updateDendaCalculation(items, total) {
            const dendaCalculation = document.getElementById('dendaCalculation');
            
            if (total > 0) {
                dendaCalculation.innerHTML = `
                    <div class="space-y-3">
                        ${items.map(item => `
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                <span class="text-red-800 font-medium">${item.description}</span>
                                <span class="text-red-600 font-semibold">Rp ${item.amount.toLocaleString('id-ID')}</span>
                            </div>
                        `).join('')}
                        <div class="flex justify-between items-center p-4 bg-red-100 rounded-lg border-2 border-red-300">
                            <span class="text-red-800 font-bold text-lg">Total Denda:</span>
                            <span class="text-red-600 font-bold text-xl">Rp ${total.toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                `;
            } else {
                dendaCalculation.innerHTML = `
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800 font-medium text-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Tidak ada denda - iPhone dikembalikan dalam kondisi baik
                        </p>
                    </div>
                `;
            }
        }

        // Check if all requirements are met
        function checkAllRequirements() {
            const dendaBayar = document.getElementById('dendaBayar');
            const ktpKembali = document.getElementById('ktpKembali');
            const konfirmasiSelesai = document.getElementById('konfirmasiSelesai');
            const selesaiBtn = document.getElementById('selesaiBtn');
            
            const allChecked = dendaBayar.checked && ktpKembali.checked && konfirmasiSelesai.checked;
            
            if (allChecked) {
                selesaiBtn.disabled = false;
                selesaiBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                selesaiBtn.disabled = true;
                selesaiBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Selesaikan pengembalian
        function selesaikanPengembalian() {
            const catatan = document.getElementById('catatanPemeriksaan').value;
            const totalPenalty = document.getElementById('totalPenalty').textContent;
            
            if (confirm('Apakah Anda yakin semua proses pengembalian telah selesai dengan benar?')) {
                // Show loading state
                const btn = document.getElementById('selesaiBtn');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Memproses...';
                btn.disabled = true;
                
                setTimeout(() => {
                    alert(`Pengembalian iPhone berhasil diselesaikan!\n\nPenyewa: John Doe\niPhone: iPhone 15 Pro Max 256GB\nIMEI: 123456789012345\nTanggal Kembali: ${new Date().toLocaleDateString('id-ID')}\nTotal Denda: ${totalPenalty}\n\nKTP telah dikembalikan kepada penyewa.\nStatus rental: SELESAI\nStatus iPhone: TERSEDIA`);
                    
                    // In real implementation:
                    // - Update database status
                    // - Return iPhone to available inventory
                    // - Send completion notification to customer
                    // - Generate return receipt
                    
                    window.location.href = 'dashboard-admin.html';
                }, 1500);
            }
        }

        // Batalkan proses
        function batalkanProses() {
            if (confirm('Apakah Anda yakin ingin membatalkan proses pengembalian ini?')) {
                alert('Proses pengembalian dibatalkan.\nStatus rental tetap "Aktif".');
                window.location.href = 'dashboard-admin.html';
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to condition selects
            const conditionSelects = document.querySelectorAll('.condition-select');
            conditionSelects.forEach(select => {
                select.addEventListener('change', calculatePenalty);
            });
            
            // Add event listeners to checkboxes
            const checkboxes = ['dendaBayar', 'ktpKembali', 'konfirmasiSelesai'];
            checkboxes.forEach(id => {
                document.getElementById(id).addEventListener('change', checkAllRequirements);
            });
            
            // Initial calculation
            calculatePenalty();
            
            console.log('Proses pengembalian page loaded');
        });
 </script>
@endpush


