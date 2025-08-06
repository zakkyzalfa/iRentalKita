@extends('layouts.admin')

@section('title', 'Manajemen Penyewa')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <!-- Header & Card Total Penyewa -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-purple-600 p-6 w-64">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Penyewa</p>
                    <p class="text-3xl font-bold text-gray-900" id="totalCustomers">{{ $penyewas->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Dropdown -->
    <div class="max-w-7xl mx-auto px-8 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-6 flex flex-col sm:flex-row items-center gap-4">
            <label for="sortFilter" class="text-sm font-medium text-gray-700">Urutkan Berdasarkan:</label>
            <select id="sortFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="terbaru">Tanggal Daftar Terbaru</option>
                <option value="terlama">Tanggal Daftar Terlama</option>
            </select>
        </div>
    </div>

    <!-- Tabel Penyewa -->
    <div class="max-w-7xl mx-auto px-8">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">No. HP</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Alamat</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">No. KTP</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tanggal Daftar</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="penyewaTableBody">
                        @foreach($penyewas as $penyewa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $penyewa->nama }}</td>
                            <td class="px-6 py-4">{{ $penyewa->email }}</td>
                            <td class="px-6 py-4">{{ $penyewa->no_hp }}</td>
                            <td class="px-6 py-4">{{ $penyewa->alamat }}</td>
                            <td class="px-6 py-4">{{ $penyewa->no_ktp }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($penyewa->tanggal_daftar)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <button 
                                    onclick="showDetailModal({{ json_encode($penyewa) }})"
                                    class="text-blue-600 hover:text-blue-800 font-medium mr-2 focus:outline-none"
                                >
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <form action="{{ route('admin.hapus-penyewa', $penyewa->id_penyewa) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Yakin hapus penyewa?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($penyewas->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-6">Belum ada data penyewa.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Enhanced Modal Detail Penyewa -->
    <div id="modalDetail" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4 animate-fadeIn">
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl transform transition-all duration-300 animate-slideIn">
            <!-- Enhanced Header with Gradient -->
            <div class="relative bg-gradient-to-r from-blue-600 to-blue-600 text-white p-8 rounded-t-2xl">
                <div class="absolute inset-0 bg-black/10 rounded-t-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-user text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Detail Penyewa</h2>
                            <p class="text-blue-100 text-sm mt-1">Informasi lengkap data penyewa</p>
                        </div>
                    </div>
                    <button 
                        onclick="closeDetailModal()"
                        class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-200 backdrop-blur-sm"
                    >
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Enhanced Content -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Personal Information Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-blue-900">Informasi Personal</h3>
                        </div>
                        <div class="space-y-4" id="personalInfo">
                            <!-- Content will be populated by JavaScript -->
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-green-900">Informasi Kontak</h3>
                        </div>
                        <div class="space-y-4" id="contactInfo">
                            <!-- Content will be populated by JavaScript -->
                        </div>
                    </div>

                    <!-- Registration Information Card -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200 lg:col-span-2">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-alt text-white"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-purple-900">Informasi Pendaftaran</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="registrationInfo">
                            <!-- Content will be populated by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end mt-8 pt-6 border-t border-gray-200">
                    <button 
                        onclick="closeDetailModal()"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                    >
                        <i class="fas fa-check mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    
    .animate-slideIn {
        animation: slideIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from { 
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to { 
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Custom scrollbar for modal */
    #modalDetail .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    #modalDetail .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    #modalDetail .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    #modalDetail .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SORT TABLE
    let penyewas = @json($penyewas);

    function sortTableByTanggal(sort) {
        if (sort === 'terbaru') {
            penyewas.sort((a, b) => new Date(b.tanggal_daftar) - new Date(a.tanggal_daftar));
        } else {
            penyewas.sort((a, b) => new Date(a.tanggal_daftar) - new Date(b.tanggal_daftar));
        }
        renderTable();
    }

    function renderTable() {
        const tbody = document.getElementById('penyewaTableBody');
        tbody.innerHTML = '';
        if (penyewas.length === 0) {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-gray-500 py-6">Belum ada data penyewa.</td></tr>`;
            return;
        }
        penyewas.forEach(penyewa => {
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50" id="row-${penyewa.id_penyewa}">
                    <td class="px-6 py-4">${penyewa.nama}</td>
                    <td class="px-6 py-4">${penyewa.email}</td>
                    <td class="px-6 py-4">${penyewa.no_hp}</td>
                    <td class="px-6 py-4">${penyewa.alamat}</td>
                    <td class="px-6 py-4">${penyewa.no_ktp}</td>
                    <td class="px-6 py-4">${new Date(penyewa.tanggal_daftar).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'})}</td>
                    <td class="px-6 py-4">
                        <button onclick='showDetailModal(${JSON.stringify(penyewa)})' class="text-blue-600 hover:text-blue-800 font-medium mr-2 focus:outline-none">
                            <i class="fas fa-eye"></i> Detail
                        </button>
                        <button onclick="confirmDelete(${penyewa.id_penyewa}, '${penyewa.nama}')" class="text-red-600 hover:text-red-800 font-medium focus:outline-none">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            `;
        });
        document.getElementById('totalCustomers').textContent = penyewas.length;
    }

    // SweetAlert2 Delete - PRESERVED EXACTLY AS ORIGINAL
    function confirmDelete(id, nama) {
        Swal.fire({
            title: 'Hapus Penyewa?',
            html: `Anda yakin ingin menghapus <b>${nama}</b>?<br>Data tidak dapat dikembalikan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form hapus via AJAX
                deletePenyewa(id);
            }
        });
    }

    function deletePenyewa(id) {
        fetch(`/admin/manajemen-penyewa/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(res => {
            if(res.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil dihapus',
                    text: 'Data penyewa telah dihapus.',
                    confirmButtonText: 'Oke'
                });
                document.getElementById(`row-${id}`).remove();
                penyewas = penyewas.filter(p => p.id_penyewa !== id);
                document.getElementById('totalCustomers').textContent = penyewas.length;
            } else {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            }
        });
    }

    // Enhanced MODAL with better content organization
    function showDetailModal(data) {
        // Personal Information
        const personalInfo = document.getElementById('personalInfo');
        personalInfo.innerHTML = `
            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-200">
                <div class="flex items-center">
                    <i class="fas fa-user-tag text-blue-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">Nama Lengkap</span>
                </div>
                <span class="font-semibold text-gray-900">${data.nama}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-200">
                <div class="flex items-center">
                    <i class="fas fa-id-card text-blue-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">No. KTP</span>
                </div>
                <span class="font-mono text-sm font-semibold text-gray-900">${data.no_ktp}</span>
            </div>
        `;

        // Contact Information
        const contactInfo = document.getElementById('contactInfo');
        contactInfo.innerHTML = `
            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-green-200">
                <div class="flex items-center">
                    <i class="fas fa-envelope text-green-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">Email</span>
                </div>
                <span class="font-semibold text-gray-900">${data.email}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-green-200">
                <div class="flex items-center">
                    <i class="fas fa-phone text-green-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">No. HP</span>
                </div>
                <span class="font-semibold text-gray-900">${data.no_hp}</span>
            </div>
            <div class="p-3 bg-white rounded-lg border border-green-200">
                <div class="flex items-center mb-2">
                    <i class="fas fa-map-marker-alt text-green-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">Alamat</span>
                </div>
                <p class="font-semibold text-gray-900 ml-6">${data.alamat}</p>
            </div>
        `;

        // Registration Information
        const registrationInfo = document.getElementById('registrationInfo');
        const registrationDate = new Date(data.tanggal_daftar);
        const formattedDate = registrationDate.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const daysSinceRegistration = Math.floor((new Date() - registrationDate) / (1000 * 60 * 60 * 24));
        
        registrationInfo.innerHTML = `
            <div class="p-4 bg-white rounded-lg border border-purple-200">
                <div class="flex items-center mb-2">
                    <i class="fas fa-calendar-plus text-purple-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">Tanggal Daftar</span>
                </div>
                <p class="font-semibold text-gray-900 ml-6">${formattedDate}</p>
            </div>
            <div class="p-4 bg-white rounded-lg border border-purple-200">
                <div class="flex items-center mb-2">
                    <i class="fas fa-clock text-purple-600 mr-3"></i>
                    <span class="text-sm font-medium text-gray-600">Lama Terdaftar</span>
                </div>
                <p class="font-semibold text-gray-900 ml-6">${daysSinceRegistration} hari</p>
            </div>
        `;

        // Show modal with animation
        const modal = document.getElementById('modalDetail');
        modal.classList.remove('hidden');
        
        // Focus management for accessibility
        setTimeout(() => {
            modal.querySelector('button').focus();
        }, 300);
    }

    function closeDetailModal() {
        const modal = document.getElementById('modalDetail');
        modal.classList.add('hidden');
    }

    // CLOSE MODAL ON BACKDROP CLICK & ESC KEY
    document.addEventListener('DOMContentLoaded', function() {
        // Initial sort by terbaru
        sortTableByTanggal('terbaru');
        document.getElementById('sortFilter').addEventListener('change', function() {
            sortTableByTanggal(this.value);
        });

        // Modal backdrop click
        document.getElementById('modalDetail').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        // ESC key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
            }
        });
    });
</script>
@endpush
@endsection
