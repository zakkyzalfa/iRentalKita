@extends('layouts.app')

@section('title', 'Daftar iPhone')

@section('content')
<!-- Hero Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Daftar iPhone Tersedia</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pilih iPhone yang Anda inginkan dari daftar iphone terlengkap kami. Semua device dalam kondisi baik, terawat, dan siap pakai dengan harga rental terjangkau.
            </p>
        </div>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">

            <!-- Search Bar -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari tipe iPhone..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Dropdown: Status -->
            <div class="relative min-w-[180px]">
                <button id="statusDropdownBtn" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium border-2 border-gray-300 hover:border-gray-800 hover:text-gray-800 transition-all duration-300 flex items-center justify-between w-full">
                    <span id="selectedStatusText">Semua Status</span>
                    <i class="fas fa-chevron-down text-sm ml-2"></i>
                </button>
                <div id="statusDropdown" class="hidden absolute top-full left-0 mt-2 bg-white border-2 border-gray-300 rounded-lg shadow-lg z-10 min-w-48 w-full">
                    <button onclick="filterByStatus('all')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Semua Status</button>
                    <button onclick="filterByStatus('tersedia')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Tersedia</button>
                    <button onclick="filterByStatus('disewa')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Disewa</button>
                    <button onclick="filterByStatus('rusak')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Rusak</button>
                </div>
            </div>

            <!-- Dropdown: Urutan -->
            <div class="relative min-w-[180px]">
                <button id="sortDropdownBtn" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium border-2 border-gray-300 hover:border-gray-800 hover:text-gray-800 transition-all duration-300 flex items-center justify-between w-full">
                    <span id="selectedSortText">Urutkan Tipe</span>
                    <i class="fas fa-chevron-down text-sm ml-2"></i>
                </button>
                <div id="sortDropdown" class="hidden absolute top-full left-0 mt-2 bg-white border-2 border-gray-300 rounded-lg shadow-lg z-10 min-w-48 w-full">
                    <button onclick="sortBy('tipe')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Urutkan Tipe</button>
                    <button onclick="sortBy('asc')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Harga Termurah</button>
                    <button onclick="sortBy('desc')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Harga Termahal</button>
                </div>
            </div>

            <!-- Dropdown: Warna -->
            <div class="relative min-w-[180px]">
                <button id="colorDropdownBtn" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium border-2 border-gray-300 hover:border-gray-800 hover:text-gray-800 transition-all duration-300 flex items-center justify-between w-full">
                    <span id="selectedColorText">Semua Warna</span>
                    <i class="fas fa-chevron-down text-sm ml-2"></i>
                </button>
                <div id="colorDropdown" class="hidden absolute top-full left-0 mt-2 bg-white border-2 border-gray-300 rounded-lg shadow-lg z-10 min-w-48 w-full">
                    <button onclick="filterByColor('all')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Semua Warna</button>
                    @foreach($allColors as $color)
                        <button onclick="filterByColor('{{ strtolower($color) }}')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">{{ $color }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- iPhone List -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div id="phoneGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($iphones as $iphone)
            @php
                $isRusak = strtolower($iphone->kondisi) == 'rusak';
                $isTersedia = strtolower($iphone->status) == 'tersedia' && !$isRusak;
                $isDisewa = strtolower($iphone->status) == 'disewa';
            @endphp
            <div 
                class="phone-card bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500"
                data-name="{{ strtolower($iphone->tipe_iphone) }}"
                data-color="{{ strtolower($iphone->warna) }}"
                data-status="{{ $isRusak ? 'rusak' : strtolower($iphone->status) }}"
                data-harga="{{ $iphone->harga_per_hari }}"
            >
                <div class="relative">
                    <div class="p-6">
                        <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                            <img src="{{ $iphone->gambar ?: asset('img/default-iphone.png') }}" alt="{{ $iphone->tipe_iphone }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    @if($isTersedia)
                        <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Tersedia</div>
                    @elseif($isDisewa)
                        <div class="absolute top-6 right-6 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium">Disewa</div>
                    @elseif($isRusak)
                        <div class="absolute top-6 right-6 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-medium">Rusak</div>
                    @else
                        <div class="absolute top-6 right-6 bg-gray-400 text-white px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($iphone->status) }}</div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $iphone->tipe_iphone }}</h3>
                    <p class="text-gray-600 mb-4">{{ $iphone->warna }}</p>
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($iphone->harga_per_hari) }}</span>
                        <span class="text-gray-500 text-lg">/hari</span>
                    </div>
                    @if($isTersedia)
                        @if(Auth::guard('penyewa')->check())
                            <a href="{{ route('detail-iphone', $iphone->id_iphone) }}"
                                class="block w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500 text-center">
                                Sewa Sekarang
                            </a>
                        @else
                            <button type="button"
                                onclick="showLoginAlert()"
                                class="block w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500 text-center">
                                Sewa Sekarang
                            </button>
                        @endif
                    @elseif($isDisewa)
                        <button class="w-full bg-gray-400 text-white py-2 rounded-full font-semibold cursor-not-allowed" disabled>
                            Tidak Tersedia
                        </button>
                    @elseif($isRusak)
                        <button class="w-full bg-gray-400 text-white py-2 rounded-full font-semibold cursor-not-allowed" disabled>
                            Sedang Maintenance
                        </button>
                    @else
                        <button class="w-full bg-gray-400 text-white py-2 rounded-full font-semibold cursor-not-allowed" disabled>
                            Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>
            @empty
            <div id="noResults" class="w-full text-center py-16">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada iPhone yang ditemukan</h3>
                <p class="text-gray-600">Coba ubah kata kunci pencarian atau filter yang Anda gunakan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Flagship urutan tipe dari tertinggi ke terendah (update sesuai database jika ada tipe baru)
    const tipeOrder = [
        'iphone 16 pro max', 'iphone 16 pro', 'iphone 16',
        'iphone 15 pro max', 'iphone 15 pro', 'iphone 15', 'iphone 15 plus',
        'iphone 14 pro max', 'iphone 14 pro', 'iphone 14', 'iphone 14 plus',
        'iphone 13 pro max', 'iphone 13 pro', 'iphone 13', 'iphone 13 mini',
        'iphone 12 pro max', 'iphone 12 pro', 'iphone 12', 'iphone 12 mini',
        'iphone 11 pro max', 'iphone 11 pro', 'iphone 11'
    ];

    const searchInput = document.getElementById('searchInput');
    const phoneCards = document.querySelectorAll('.phone-card');
    const noResults = document.getElementById('noResults');
    let selectedColor = 'all';
    let selectedStatus = 'all';
    let sortOrder = 'tipe'; // default: tipe

    // Dropdown helpers
    function setupDropdown(btnId, dropdownId, selectedTextId) {
        const btn = document.getElementById(btnId);
        const dropdown = document.getElementById(dropdownId);
        const selectedText = selectedTextId ? document.getElementById(selectedTextId) : null;
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', function() {
            dropdown.classList.add('hidden');
        });
        return { btn, dropdown, selectedText };
    }

    // Status Dropdown
    setupDropdown('statusDropdownBtn', 'statusDropdown', 'selectedStatusText');
    window.filterByStatus = function(status) {
        selectedStatus = status;
        document.getElementById('selectedStatusText').textContent =
            status === 'all' ? 'Semua Status' : (status.charAt(0).toUpperCase() + status.slice(1));
        document.getElementById('statusDropdown').classList.add('hidden');
        filterAndSortCards();
    };

    // Sort Dropdown
    setupDropdown('sortDropdownBtn', 'sortDropdown', 'selectedSortText');
    window.sortBy = function(order) {
        sortOrder = order;
        let text = 'Urutkan Tipe';
        if(order === 'asc') text = 'Harga Termurah';
        else if(order === 'desc') text = 'Harga Termahal';
        document.getElementById('selectedSortText').textContent = text;
        document.getElementById('sortDropdown').classList.add('hidden');
        filterAndSortCards();
    };

    // Color Dropdown
    setupDropdown('colorDropdownBtn', 'colorDropdown', 'selectedColorText');
    window.filterByColor = function(color) {
        selectedColor = color;
        document.getElementById('selectedColorText').textContent =
            color === 'all' ? 'Semua Warna' : (color.charAt(0).toUpperCase() + color.slice(1));
        document.getElementById('colorDropdown').classList.add('hidden');
        filterAndSortCards();
    };

    // Search
    searchInput.addEventListener('input', filterAndSortCards);

    function filterAndSortCards() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let visibleCards = 0;
        let cardsArray = Array.from(phoneCards);

        // Filter
        cardsArray.forEach(card => {
            const tipe = card.dataset.name;
            const warna = card.dataset.color;
            const status = card.dataset.status;
            let show = true;

            if (searchTerm && !tipe.includes(searchTerm)) show = false;
            if (selectedColor !== 'all' && warna !== selectedColor) show = false;
            if (selectedStatus !== 'all' && status !== selectedStatus) show = false;

            card.style.display = show ? 'block' : 'none';
            card.dataset.visible = show ? '1' : '0';
            if (show) visibleCards++;
        });

        // Sort
        // Only sort visible cards!
        let sortedCards = cardsArray.filter(card => card.dataset.visible === '1');
        if(sortOrder === 'tipe') {
            // Sort by flagship order
            sortedCards.sort((a,b) => {
                let idxA = tipeOrder.indexOf(a.dataset.name);
                let idxB = tipeOrder.indexOf(b.dataset.name);
                idxA = idxA === -1 ? 999 : idxA; // unknown tipe di paling bawah
                idxB = idxB === -1 ? 999 : idxB;
                return idxA - idxB;
            });
        } else if(sortOrder === 'asc') {
            sortedCards.sort((a,b) => parseInt(a.dataset.harga) - parseInt(b.dataset.harga));
        } else if(sortOrder === 'desc') {
            sortedCards.sort((a,b) => parseInt(b.dataset.harga) - parseInt(a.dataset.harga));
        }
        // Reorder DOM
        const phoneGrid = document.getElementById('phoneGrid');
        sortedCards.forEach(card => phoneGrid.appendChild(card));

        // Show/hide no results
        if (visibleCards === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    // Init
    filterAndSortCards();
});
</script>

<script>
    function showLoginAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Login Diperlukan',
            text: 'Anda Harus Login Terlebih Dahulu, Sebelum Menyewa iPhone',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login-penyewa') }}";
            }
        });
    }
</script>
@endpush