@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
    <!-- Main Content -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-2xl p-8 text-white shadow-sm border-2 border-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Manajemen Penyewa</h1>
                        <p class="text-purple-100 text-lg">Kelola data dan aktivitas penyewa</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-users text-6xl text-purple-200"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Penyewa</p>
                            <p class="text-3xl font-bold text-gray-900" id="totalCustomers">156</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Aktif Menyewa</p>
                            <p class="text-3xl font-bold text-orange-600" id="activeCustomers">6</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-clock text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Penyewa Baru</p>
                            <p class="text-3xl font-bold text-green-600" id="newCustomers">12</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-plus text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Bulan ini</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Bermasalah</p>
                            <p class="text-3xl font-bold text-red-600" id="problematicCustomers">2</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-times text-red-600 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Terlambat/Denda</p>
                </div>
            </div>
        </div>

        <!-- Filters & Actions -->
        <div class="max-w-7xl mx-auto px-8 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Filters -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div>
                            <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">Semua Status</option>
                                <option value="active">Aktif Menyewa</option>
                                <option value="inactive">Tidak Aktif</option>
                                <option value="problematic">Bermasalah</option>
                            </select>
                        </div>
                        
                        <div>
                            <select id="sortFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="name">Urutkan: Nama</option>
                                <option value="date">Urutkan: Tanggal Daftar</option>
                                <option value="rentals">Urutkan: Total Rental</option>
                            </select>
                        </div>
                        
                        <div>
                            <input type="text" id="searchInput" placeholder="Cari nama, email, atau telepon..." class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer List -->
        <div class="max-w-7xl mx-auto px-8">
            <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Penyewa</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Kontak</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Total Rental</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Bergabung</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody" class="divide-y divide-gray-200">
                            <!-- Customer rows will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Detail Modal -->
    <div id="customerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">Detail Penyewa</h2>
                    <button onclick="closeCustomerModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div id="customerDetailContent" class="p-6">
                <!-- Customer detail content will be populated here -->
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Sample customer data
        const customers = [
            {
                id: 1,
                name: 'John Doe',
                email: 'john.doe@email.com',
                phone: '+62 812-3456-7890',
                ktp: '3201234567890123',
                status: 'active',
                totalRentals: 5,
                totalSpent: 1250000,
                joinDate: '2024-01-15',
                lastRental: '2025-01-20',
                currentRental: 'iPhone 15 Pro Max',
                notes: 'Penyewa yang baik, selalu tepat waktu'
            },
            {
                id: 2,
                name: 'Sarah Wilson',
                email: 'sarah.wilson@email.com',
                phone: '+62 812-3456-7891',
                ktp: '3201234567890124',
                status: 'active',
                totalRentals: 3,
                totalSpent: 798000,
                joinDate: '2024-03-10',
                lastRental: '2025-01-21',
                currentRental: 'iPhone 14 Pro',
                notes: 'Penyewa baru, responsif'
            },
            {
                id: 3,
                name: 'Mike Johnson',
                email: 'mike.johnson@email.com',
                phone: '+62 812-3456-7892',
                ktp: '3201234567890125',
                status: 'problematic',
                totalRentals: 2,
                totalSpent: 175000,
                joinDate: '2024-02-20',
                lastRental: '2025-01-15',
                currentRental: 'iPhone 13',
                notes: 'Terlambat mengembalikan, denda Rp 50.000'
            },
            {
                id: 4,
                name: 'Lisa Chen',
                email: 'lisa.chen@email.com',
                phone: '+62 812-3456-7893',
                ktp: '3201234567890126',
                status: 'inactive',
                totalRentals: 8,
                totalSpent: 2100000,
                joinDate: '2023-11-05',
                lastRental: '2024-12-10',
                currentRental: null,
                notes: 'Penyewa lama, tidak aktif 1 bulan terakhir'
            },
            {
                id: 5,
                name: 'David Brown',
                email: 'david.brown@email.com',
                phone: '+62 812-3456-7894',
                ktp: '3201234567890127',
                status: 'inactive',
                totalRentals: 12,
                totalSpent: 3200000,
                joinDate: '2023-08-12',
                lastRental: '2024-11-25',
                currentRental: null,
                notes: 'Penyewa VIP, sering rental'
            }
        ];

        // Status mappings
        const statusLabels = {
            'active': { label: 'Aktif Menyewa', class: 'bg-orange-100 text-orange-800' },
            'inactive': { label: 'Tidak Aktif', class: 'bg-gray-100 text-gray-800' },
            'problematic': { label: 'Bermasalah', class: 'bg-red-100 text-red-800' }
        };

        // Render customer table
        function renderCustomers(data = customers) {
            const tbody = document.getElementById('customerTableBody');
            tbody.innerHTML = '';

            data.forEach(customer => {
                const statusInfo = statusLabels[customer.status];
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                
                row.innerHTML = `
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-medium mr-3">
                                ${customer.name.charAt(0)}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">${customer.name}</div>
                                <div class="text-sm text-gray-600">KTP: ${customer.ktp}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">
                            <div class="text-gray-900">${customer.email}</div>
                            <div class="text-gray-600">${customer.phone}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium ${statusInfo.class}">
                            ${statusInfo.label}
                        </span>
                        ${customer.currentRental ? `<div class="text-xs text-gray-600 mt-1">${customer.currentRental}</div>` : ''}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">
                            <div class="font-semibold text-gray-900">${customer.totalRentals} kali</div>
                            <div class="text-gray-600">Rp ${customer.totalSpent.toLocaleString('id-ID')}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">${new Date(customer.joinDate).toLocaleDateString('id-ID')}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <button onclick="viewCustomer(${customer.id})" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>Detail
                            </button>
                            <button onclick="contactCustomer(${customer.id})" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                <i class="fas fa-phone mr-1"></i>Hubungi
                            </button>
                            ${customer.status === 'problematic' ? 
                                `<button onclick="resolveIssue(${customer.id})" class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Selesaikan
                                </button>` : ''
                            }
                        </div>
                    </td>
                `;
                
                tbody.appendChild(row);
            });

            updateStats(data);
        }

        // Update statistics
        function updateStats(data = customers) {
            const total = data.length;
            const active = data.filter(c => c.status === 'active').length;
            const newThisMonth = data.filter(c => {
                const joinDate = new Date(c.joinDate);
                const thisMonth = new Date();
                return joinDate.getMonth() === thisMonth.getMonth() && 
                       joinDate.getFullYear() === thisMonth.getFullYear();
            }).length;
            const problematic = data.filter(c => c.status === 'problematic').length;

            document.getElementById('totalCustomers').textContent = total;
            document.getElementById('activeCustomers').textContent = active;
            document.getElementById('newCustomers').textContent = newThisMonth;
            document.getElementById('problematicCustomers').textContent = problematic;
        }

        // Filter functions
        function filterCustomers() {
            const statusFilter = document.getElementById('statusFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;
            const searchInput = document.getElementById('searchInput').value.toLowerCase();

            let filtered = customers.filter(customer => {
                const matchesStatus = !statusFilter || customer.status === statusFilter;
                const matchesSearch = !searchInput || 
                    customer.name.toLowerCase().includes(searchInput) ||
                    customer.email.toLowerCase().includes(searchInput) ||
                    customer.phone.toLowerCase().includes(searchInput);

                return matchesStatus && matchesSearch;
            });

            // Sort data
            filtered.sort((a, b) => {
                switch(sortFilter) {
                    case 'name':
                        return a.name.localeCompare(b.name);
                    case 'date':
                        return new Date(b.joinDate) - new Date(a.joinDate);
                    case 'rentals':
                        return b.totalRentals - a.totalRentals;
                    default:
                        return 0;
                }
            });

            renderCustomers(filtered);
        }

        // Customer detail functions
        function viewCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            const content = document.getElementById('customerDetailContent');
            content.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Customer Info -->
                    <div class="space-y-6">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto mb-4">
                                ${customer.name.charAt(0)}
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">${customer.name}</h3>
                            <span class="px-3 py-1 rounded-full text-sm font-medium ${statusLabels[customer.status].class}">
                                ${statusLabels[customer.status].label}
                            </span>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <h4 class="font-semibold text-gray-900">Informasi Kontak</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-medium">${customer.email}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Telepon:</span>
                                    <span class="font-medium">${customer.phone}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">No. KTP:</span>
                                    <span class="font-medium">${customer.ktp}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <h4 class="font-semibold text-gray-900">Statistik Rental</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Rental:</span>
                                    <span class="font-medium">${customer.totalRentals} kali</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Pengeluaran:</span>
                                    <span class="font-medium">Rp ${customer.totalSpent.toLocaleString('id-ID')}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Bergabung:</span>
                                    <span class="font-medium">${new Date(customer.joinDate).toLocaleDateString('id-ID')}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Rental Terakhir:</span>
                                    <span class="font-medium">${new Date(customer.lastRental).toLocaleDateString('id-ID')}</span>
                                </div>
                                ${customer.currentRental ? `
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sedang Menyewa:</span>
                                    <span class="font-medium text-orange-600">${customer.currentRental}</span>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>

                    <!-- Rental History & Actions -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-3">Catatan Admin</h4>
                            <p class="text-sm text-gray-700">${customer.notes}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-3">Riwayat Rental Terbaru</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-white rounded border">
                                    <div>
                                        <div class="font-medium text-gray-900">iPhone 15 Pro Max</div>
                                        <div class="text-sm text-gray-600">20-25 Jan 2025</div>
                                    </div>
                                    <span class="text-green-600 font-medium">Selesai</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white rounded border">
                                    <div>
                                        <div class="font-medium text-gray-900">iPhone 14 Pro</div>
                                        <div class="text-sm text-gray-600">10-15 Jan 2025</div>
                                    </div>
                                    <span class="text-green-600 font-medium">Selesai</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white rounded border">
                                    <div>
                                        <div class="font-medium text-gray-900">iPhone 13</div>
                                        <div class="text-sm text-gray-600">25-30 Des 2024</div>
                                    </div>
                                    <span class="text-green-600 font-medium">Selesai</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button onclick="contactCustomer(${customer.id})" class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-green-700 transition-colors flex items-center justify-center">
                                <i class="fas fa-phone mr-2"></i>
                                Hubungi Penyewa
                            </button>
                            <button onclick="sendNotification(${customer.id})" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
                                <i class="fas fa-bell mr-2"></i>
                                Kirim Notifikasi
                            </button>
                            ${customer.status === 'problematic' ? `
                            <button onclick="resolveIssue(${customer.id})" class="w-full bg-orange-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-orange-700 transition-colors flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Selesaikan Masalah
                            </button>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('customerModal').classList.remove('hidden');
        }

        function closeCustomerModal() {
            document.getElementById('customerModal').classList.add('hidden');
        }

        function contactCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            alert(`Menghubungi ${customer.name}:\n\nOpsi kontak:\n- Telepon: ${customer.phone}\n- WhatsApp: ${customer.phone}\n- Email: ${customer.email}\n\nPilih metode komunikasi yang sesuai.`);
        }

        function sendNotification(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            const message = prompt(`Kirim notifikasi ke ${customer.name}:\n\nMasukkan pesan:`);
            if (message) {
                alert(`Notifikasi berhasil dikirim ke ${customer.name}!\n\nPesan: "${message}"\n\nDikirim via: Email & WhatsApp`);
            }
        }

        function resolveIssue(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            if (confirm(`Apakah masalah dengan ${customer.name} sudah diselesaikan?\n\nIni akan mengubah status menjadi "Tidak Aktif".`)) {
                customer.status = 'inactive';
                customer.notes = customer.notes + ' - Masalah diselesaikan pada ' + new Date().toLocaleDateString('id-ID');
                renderCustomers();
                alert(`Status ${customer.name} berhasil diubah menjadi "Tidak Aktif".`);
            }
        }

        function exportCustomers() {
            alert('Fitur export data penyewa akan segera tersedia!\n\nData akan diekspor dalam format:\n- Excel (.xlsx) - Data lengkap penyewa\n- PDF - Laporan penyewa\n- CSV - Data untuk import');
        }

        function sendBulkNotification() {
            const message = prompt('Kirim notifikasi massal ke semua penyewa:\n\nMasukkan pesan:');
            if (message) {
                alert(`Notifikasi massal berhasil dikirim!\n\nPesan: "${message}"\nDikirim ke: ${customers.length} penyewa\nMetode: Email & WhatsApp`);
            }
        }

        // Event listeners
        document.getElementById('statusFilter').addEventListener('change', filterCustomers);
        document.getElementById('sortFilter').addEventListener('change', filterCustomers);
        document.getElementById('searchInput').addEventListener('input', filterCustomers);

        // Close modal when clicking outside
        document.getElementById('customerModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCustomerModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            renderCustomers();
            console.log('Manajemen Penyewa page loaded');
        });
 </script>
@endpush


