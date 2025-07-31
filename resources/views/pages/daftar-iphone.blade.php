@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-gray-900 mb-4">Daftar iPhone Tersedia</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Temukan iPhone impian Anda dari koleksi terlengkap kami. Semua device dalam kondisi prima, terawat, dan siap pakai dengan harga rental terjangkau.
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
                        <input type="text" id="searchInput" placeholder="Cari iPhone..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-3 items-center">
                    <button onclick="filterPhones('all')" class="filter-btn active bg-gray-800 text-white px-4 py-2 rounded-lg font-medium hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300">
                        Semua
                    </button>
                    <button onclick="filterPhones('available')" class="filter-btn bg-white text-gray-700 px-4 py-2 rounded-lg font-medium border-2 border-gray-300 hover:border-gray-800 hover:text-gray-800 transition-all duration-300">
                        Tersedia
                    </button>
                    
                    <!-- Color Filter Dropdown -->
                    <div class="relative">
                        <button id="colorDropdownBtn" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium border-2 border-gray-300 hover:border-gray-800 hover:text-gray-800 transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-palette"></i>
                            Filter Warna
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <div id="colorDropdown" class="hidden absolute top-full left-0 mt-2 bg-white border-2 border-gray-300 rounded-lg shadow-lg z-10 min-w-48">
                            <button onclick="filterByColor('all')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Semua Warna</button>
                            <button onclick="filterByColor('titanium')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Titanium</button>
                            <button onclick="filterByColor('blue')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Blue</button>
                            <button onclick="filterByColor('pink')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Pink</button>
                            <button onclick="filterByColor('green')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Green</button>
                            <button onclick="filterByColor('black')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Black</button>
                            <button onclick="filterByColor('purple')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Purple</button>
                            <button onclick="filterByColor('white')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">White/Starlight</button>
                            <button onclick="filterByColor('midnight')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition-colors">Midnight</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- iPhone List -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div id="phoneGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                
            @foreach ($iphones as $iphone)
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-gray-800 transition-all duration-500">
                <div class="relative">
                    <div class="p-6">
                        <div class="aspect-square rounded-xl overflow-hidden bg-gray-50">
                            <img src="{{ asset('images/' . $iphone->gambar) }}" alt="{{ $iphone->tipe_iphone }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="absolute top-6 right-6 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ ucfirst($iphone->status) }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $iphone->tipe_iphone }}</h3>
                    <p class="text-gray-600 mb-4">{{ $iphone->warna }}</p>
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($iphone->harga_per_hari) }}</span>
                        <span class="text-gray-500 text-lg">/hari</span>
                    </div>
                    <button class="w-full bg-gray-800 text-white py-2 rounded-full font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-500">
                        Sewa Sekarang
                    </button>
                </div>
            </div>
            @endforeach

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-16">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada iPhone yang ditemukan</h3>
                <p class="text-gray-600">Coba ubah kata kunci pencarian atau filter yang Anda gunakan.</p>
            </div>
        </div>
    </section>

    <!-- Demo Toggle Button (untuk testing) -->
    <div class="fixed bottom-4 right-4 z-50">
        <button onclick="toggleLoginState()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition-all duration-300">
            <i class="fas fa-user-circle mr-2"></i>
            Toggle Login State
        </button>
    </div>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const phoneCards = document.querySelectorAll('.phone-card');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleCards = 0;

            phoneCards.forEach(card => {
                const phoneName = card.dataset.name.toLowerCase();
                if (phoneName.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCards === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });

        // Filter functionality
        function filterPhones(category) {
            let visibleCards = 0;

            // Update active filter button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-gray-800', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });
            
            event.target.classList.add('active', 'bg-gray-800', 'text-white');
            event.target.classList.remove('bg-white', 'text-gray-700');

            phoneCards.forEach(card => {
                const cardCategories = card.dataset.category.split(' ');
                
                if (category === 'all' || cardCategories.includes(category)) {
                    card.style.display = 'block';
                    visibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCards === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }

            // Clear search input when filtering
            searchInput.value = '';
        }

    

        // Color dropdown functionality
        const colorDropdownBtn = document.getElementById('colorDropdownBtn');
        const colorDropdown = document.getElementById('colorDropdown');

        colorDropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            colorDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            colorDropdown.classList.add('hidden');
        });

        // Color filter functionality
        function filterByColor(color) {
            let visibleCards = 0;
            
            phoneCards.forEach(card => {
                const cardColor = card.dataset.color.toLowerCase();
                
                if (color === 'all' || cardColor.includes(color)) {
                    card.style.display = 'block';
                    visibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCards === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }

            // Update dropdown button text
            const colorNames = {
                'all': 'Semua Warna',
                'titanium': 'Titanium',
                'blue': 'Blue',
                'pink': 'Pink', 
                'green': 'Green',
                'black': 'Black',
                'purple': 'Purple',
                'white': 'White/Starlight',
                'midnight': 'Midnight'
            };
            
            colorDropdownBtn.innerHTML = `
                <i class="fas fa-palette"></i>
                ${colorNames[color]}
                <i class="fas fa-chevron-down text-sm"></i>
            `;
            
            // Close dropdown
            colorDropdown.classList.add('hidden');
            
            // Clear search input when filtering
            searchInput.value = '';
        }
 </script>
@endpush


