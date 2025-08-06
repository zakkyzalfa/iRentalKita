@extends('layouts.admin')

@section('title', 'Manajemen iPhone')

@section('content')
<section class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-8 mb-8">

        {{-- HEADER INFO STATISTIK --}}
        <div class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl border-2 border-blue-600 shadow flex items-center px-6 py-5">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Total iPhone</p>
                        <div class="text-2xl font-bold mt-1 text-gray-900">{{ $totalIphone }}</div>
                    </div>
                    <div class="ml-4 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border-2 border-green-500 shadow flex items-center px-6 py-5">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">iPhone Tersedia</p>
                        <div class="text-2xl font-bold mt-1 text-green-600">{{ $tersedia }}</div>
                    </div>
                    <div class="ml-4 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border-2 border-orange-400 shadow flex items-center px-6 py-5">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">iPhone Disewa</p>
                        <div class="text-2xl font-bold mt-1 text-orange-600">{{ $disewa }}</div>
                    </div>
                    <div class="ml-4 w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart text-orange-600 text-xl"></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border-2 border-red-500 shadow flex items-center px-6 py-5">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">iPhone Rusak</p>
                        <div class="text-2xl font-bold mt-1 text-red-600">{{ $rusak }}</div>
                    </div>
                    <div class="ml-4 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-tools text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER DAN SEARCH --}}
        <form id="filterForm" method="GET" class="flex flex-col md:flex-row items-center gap-4 bg-white p-6 rounded-2xl border shadow mb-6">
            <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status')=='tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="disewa" {{ request('status')=='disewa' ? 'selected' : '' }}>Disewa</option>
            </select>
            <select name="color" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="">Semua Warna</option>
                @foreach($allColors as $color)
                    <option value="{{ $color }}" {{ request('color')==$color ? 'selected' : '' }}>{{ $color }}</option>
                @endforeach
            </select>
            <input type="text" name="q" class="border border-gray-300 rounded-lg px-4 py-2 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Tipe iPhone..." value="{{ request('q') }}" onkeypress="if(event.key==='Enter'){this.form.submit();}">
            <button type="button" onclick="openIphoneModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center ml-auto">
                <i class="fas fa-plus mr-2"></i>Tambah iPhone
            </button>
        </form>

        {{-- TABEL DATA --}}
        <div class="bg-white rounded-2xl shadow border border-gray-200 overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tipe</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">IMEI</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Warna</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Kondisi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Harga/Hari</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Gambar</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                @section('iphonesTable')
                <tbody id="iphones-table">
                    @forelse($iphones as $iphone)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $iphone->tipe_iphone }}</td>
                        <td class="px-6 py-4 font-mono text-sm text-gray-900">{{ $iphone->imei }}</td>
                        <td class="px-6 py-4">{{ $iphone->warna }}</td>
                        <td class="px-6 py-4">
                            @if($iphone->status == 'tersedia')
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Tersedia</span>
                            @elseif($iphone->status == 'disewa')
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">Disewa</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ ucfirst($iphone->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">{{ ucfirst($iphone->kondisi) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-900">Rp {{ number_format($iphone->harga_per_hari) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($iphone->gambar)
                                <img src="{{ $iphone->gambar }}" alt="gambar" class="w-14 h-14 object-cover rounded border border-gray-200">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <button onclick='editIphone(@json($iphone))' class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                <form class="form-delete" action="{{ route('admin.iphones.destroy', ['id_iphone' => $iphone->id_iphone]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-400">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
                @show
            </table>
        </div>
    </div>
</section>

{{-- ENHANCED MODAL TAMBAH/EDIT --}}
<div id="iphoneModal" class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-5xl w-full max-h-[120vh] overflow-hidden shadow-2xl transform transition-all duration-300 scale-95 modal-content">
        
        {{-- Enhanced Modal Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-600 px-8 py-3 text-white relative overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-32 h-32 bg-white rounded-full -translate-x-16 -translate-y-16"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-white rounded-full translate-x-12 translate-y-12"></div>
            </div>
            
            {{-- Close Button --}}
            <button onclick="closeModal()" class="absolute top-4 right-6 text-white hover:text-gray-200 transition-all duration-200 hover:rotate-90 z-10">
                <i class="fas fa-times text-2xl"></i>
            </button>
            
            {{-- Header Content --}}
            <div class="flex items-center space-x-4 relative z-10">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white border-opacity-30">
                    <i class="fas fa-mobile-alt text-3xl"></i>
                </div>
                <div>
                    <h2 id="modalTitle" class="text-2xl font-bold">Tambah iPhone</h2>
                </div>
            </div>
        </div>

        {{-- Enhanced Modal Content --}}
        <div class="overflow-y-auto max-h-[calc(105vh-140px)] bg-gray-50">
            <form id="iphoneForm" method="POST" action="{{ route('admin.iphones.store') }}" class="p-8">
                @csrf
                <input type="hidden" id="formMethod" name="_method" value="POST">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Left Column --}}
                    <div class="space-y-6">
                        {{-- Basic Information Card --}}
                        <div class="bg-white rounded-2xl p-6 border border-gray-200">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Informasi Dasar</h3>
                                    <p class="text-sm text-gray-500">Data utama iPhone</p>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-mobile-alt mr-2 text-blue-500"></i>
                                        Tipe iPhone
                                    </label>
                                    <input type="text" name="tipe_iphone" id="tipe_iphone" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" 
                                           placeholder="contoh: iPhone 14 Pro Max" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-barcode mr-2 text-blue-500"></i>
                                        IMEI
                                    </label>
                                    <input type="text" name="imei" id="imei" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300 font-mono" 
                                           placeholder="15 digit IMEI" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-palette mr-2 text-blue-500"></i>
                                        Warna
                                    </label>
                                    <input type="text" name="warna" id="warna" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" 
                                           placeholder="contoh: Black, White, Gold" required>
                                </div>
                            </div>
                        </div>

                        {{-- Status & Condition Card --}}
                        <div class="bg-white rounded-2xl p-6 border border-gray-200">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-cog text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Status & Kondisi</h3>
                                    <p class="text-sm text-gray-500">Ketersediaan dan kondisi</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                        Status
                                    </label>
                                    <select name="status" id="status" 
                                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" required>
                                        <option value="tersedia">✅ Tersedia</option>
                                        <option value="disewa">🔄 Disewa</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-shield-alt mr-2 text-blue-500"></i>
                                        Kondisi
                                    </label>
                                    <select name="kondisi" id="kondisi" 
                                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" required>
                                        <option value="baik">✅ Baik</option>
                                        <option value="rusak">⚠️ Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Price Card --}}
                        <div class="bg-white rounded-2xl p-6 border border-gray-200">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-money-bill-wave text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Harga Rental</h3>
                                    <p class="text-sm text-gray-500">Tarif sewa per hari</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-tag mr-2 text-blue-500"></i>
                                    Harga per Hari (Rp)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" name="harga_per_hari" id="harga_per_hari" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pl-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" 
                                           placeholder="50000" required>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Masukkan harga rental per hari
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-6">
                        {{-- Image Upload Card --}}
                        <div class="bg-white rounded-2xl p-6 border border-gray-200">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-image text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Gambar iPhone</h3>
                                    <p class="text-sm text-gray-500">Upload foto produk</p>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-link mr-2 text-blue-500"></i>
                                        URL Gambar
                                    </label>
                                    <input type="url" name="gambar" id="gambar" 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300" 
                                           placeholder="https://example.com/iphone.jpg" oninput="previewImageURL()">
                                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Masukkan URL gambar iPhone dari internet
                                    </p>
                                </div>
                                
                                {{-- Enhanced Image Preview --}}
                                <div class="image-preview-container">
                                    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                        <div id="imagePreviewContainer" class="min-h-[200px] flex items-center justify-center">
                                            <div id="noImagePlaceholder" class="text-center">
                                                <div class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                                    <i class="fas fa-image text-2xl text-gray-400"></i>
                                                </div>
                                                <p class="text-gray-500 font-medium">Preview gambar akan muncul di sini</p>
                                                <p class="text-xs text-gray-400 mt-1">Masukkan URL gambar untuk melihat preview</p>
                                            </div>
                                            <div id="imagePreviewWrapper" class="hidden">
                                                <img id="imgPreview" src="/placeholder.svg" alt="Preview Gambar" class="max-w-full max-h-[200px] object-contain rounded-xl shadow-lg">
                                                <p class="text-center text-sm text-gray-600 mt-2 font-medium">Preview Gambar iPhone</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tips Card --}}
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border-2 border-blue-200">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-lightbulb text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-blue-900">Tips & Panduan</h3>
                                    <p class="text-sm text-blue-600">Petunjuk pengisian data</p>
                                </div>
                            </div>
                            <ul class="space-y-3 text-sm text-blue-800">
                                <li class="flex items-start space-x-3">
                                    <div class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <span>Pastikan IMEI unik dan valid (15 digit)</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <span>Gunakan gambar berkualitas tinggi dan jelas</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <span>Set harga sesuai dengan kondisi iPhone</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-5 h-5 bg-blue-200 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <span>Periksa kembali semua data sebelum menyimpan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Enhanced Form Actions --}}
                <div class="flex gap-4 pt-8 border-t-2 border-gray-200 mt-8">
                    <button type="button" onclick="closeModal()" 
                            class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white py-4 px-6 rounded-2xl font-bold transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white py-4 px-6 rounded-2xl font-bold transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>
                        Simpan iPhone
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    /* Enhanced Modal Animations */
    .modal-content {
        animation: modalSlideIn 0.3s ease-out;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    /* Form Group Enhancements */
    .form-group input:focus,
    .form-group select:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    /* Custom Scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Oke'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'Oke'
        });
    @endif

    // Konfirmasi hapus SweetAlert2
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data iPhone akan dihapus permanen!",
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

    // Enhanced Preview Image
    function previewImageURL() {
        const urlInput = document.getElementById('gambar');
        const imgPreview = document.getElementById('imgPreview');
        const noImagePlaceholder = document.getElementById('noImagePlaceholder');
        const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');
        const url = urlInput.value.trim();
        
        if (url) {
            imgPreview.src = url;
            
            imgPreview.onload = function() {
                noImagePlaceholder.classList.add('hidden');
                imagePreviewWrapper.classList.remove('hidden');
            }
            
            imgPreview.onerror = function() {
                this.onerror = null;
                imagePreviewWrapper.classList.add('hidden');
                noImagePlaceholder.classList.remove('hidden');
                noImagePlaceholder.innerHTML = `
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
                    </div>
                    <p class="text-red-500 font-medium">Gagal memuat gambar</p>
                    <p class="text-xs text-red-400 mt-1">Periksa kembali URL gambar</p>
                `;
            }
        } else {
            imgPreview.src = "";
            imagePreviewWrapper.classList.add('hidden');
            noImagePlaceholder.classList.remove('hidden');
            noImagePlaceholder.innerHTML = `
                <div class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-image text-2xl text-gray-400"></i>
                </div>
                <p class="text-gray-500 font-medium">Preview gambar akan muncul di sini</p>
                <p class="text-xs text-gray-400 mt-1">Masukkan URL gambar untuk melihat preview</p>
            `;
        }
    }

    // Modal logic
    const modal = document.getElementById('iphoneModal');
    const form = document.getElementById('iphoneForm');
    const title = document.getElementById('modalTitle');

    function openIphoneModal() {
        title.innerHTML = 'Tambah iPhone';
        form.action = "{{ route('admin.iphones.store') }}";
        form.reset();
        form.querySelector('[name=_method]').value = 'POST';
        modal.classList.remove('hidden');
        document.getElementById('gambar').value = '';
        previewImageURL();
        
        // Focus on first input with delay for animation
        setTimeout(() => {
            document.getElementById('tipe_iphone').focus();
        }, 300);
        
        Swal.fire({
            icon: 'info',
            title: 'Petunjuk',
            text: 'Isi semua data iPhone dengan benar sebelum disimpan.',
            confirmButtonText: 'Oke'
        });
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    function editIphone(data) {
        title.innerHTML = 'Edit iPhone';
        form.action = "/admin/manajemen-iphone/" + data.id_iphone;
        form.querySelector('[name=_method]').value = 'PUT';

        document.getElementById('tipe_iphone').value = data.tipe_iphone;
        document.getElementById('imei').value = data.imei;
        document.getElementById('warna').value = data.warna;
        document.getElementById('status').value = data.status;
        document.getElementById('kondisi').value = data.kondisi;
        document.getElementById('harga_per_hari').value = data.harga_per_hari;
        document.getElementById('gambar').value = data.gambar || '';
        previewImageURL();

        modal.classList.remove('hidden');
        
        // Focus on first input with delay for animation
        setTimeout(() => {
            document.getElementById('tipe_iphone').focus();
        }, 300);
    }

    // AJAX filter realtime (jika sudah implementasi AJAX filter)
    function fetchIphones() {
        const status = document.querySelector('[name="status"]').value;
        const color = document.querySelector('[name="color"]').value;
        const q = document.querySelector('[name="q"]').value;
        let url = "{{ route('admin.iphones.index') }}?ajax=1";
        if (status) url += `&status=${encodeURIComponent(status)}`;
        if (color) url += `&color=${encodeURIComponent(color)}`;
        if (q) url += `&q=${encodeURIComponent(q)}`;
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('iphones-table').innerHTML = data.html;
        });
    }
    document.querySelector('[name="status"]').addEventListener('change', fetchIphones);
    document.querySelector('[name="color"]').addEventListener('change', fetchIphones);
    document.querySelector('[name="q"]').addEventListener('input', function() {
        clearTimeout(window._filterSearchTimeout);
        window._filterSearchTimeout = setTimeout(fetchIphones, 350);
    });

    // Close modal on outside click
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>
@endpush
