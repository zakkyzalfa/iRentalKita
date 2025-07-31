<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Product Detail Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Images - 50% -->
                <div class="space-y-4">
                    <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border-2 border-gray-200">
                        <img src="../assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro Max" class="w-full h-full object-cover" id="mainImage">
                    </div>
                    
                    <!-- Thumbnail Images -->
                    <div class="grid grid-cols-4 gap-2">
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-50 border-2 border-gray-800 cursor-pointer" onclick="changeImage('../assets/images/iphone-16-pro.webp')">
                            <img src="../assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro Max" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-50 border-2 border-gray-200 hover:border-gray-800 cursor-pointer transition-colors" onclick="changeImage('../assets/images/iphone-16-pro.webp')">
                            <img src="../assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro Max Side" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-50 border-2 border-gray-200 hover:border-gray-800 cursor-pointer transition-colors" onclick="changeImage('../assets/images/iphone-16-pro.webp')">
                            <img src="../assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro Max Back" class="w-full h-full object-cover">
                        </div>
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-50 border-2 border-gray-200 hover:border-gray-800 cursor-pointer transition-colors" onclick="changeImage('../assets/images/iphone-16-pro.webp')">
                            <img src="../assets/images/iphone-16-pro.webp" alt="iPhone 15 Pro Max Camera" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Product Info - 50% -->
                <div class="space-y-6">
                    <!-- Product Title & Status -->
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">iPhone 15 Pro Max</h1>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-check-circle mr-1"></i>
                                Tersedia
                            </span>
                        </div>
                        <p class="text-xl text-gray-600">256GB • Natural Titanium</p>
                    </div>

                    <!-- Price -->
                    <div class="bg-gray-50 p-6 rounded-2xl">
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-gray-900">Rp 50.000</span>
                            <span class="text-xl text-gray-600">/hari</span>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Spesifikasi iPhone :</h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• Warna</span>
                                <span>: Hitam</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• IMEI</span>
                                <span>: 123456789123456</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• Kamera Belakang</span>
                                <span>: 48MP utama</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• Kamera Depan</span>
                                <span>: 12MP ultra-wide</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• Baterai</span>
                                <span>: 3,274 mAh</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• Penyimpanan</span>
                                <span>: 512GB</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• Processor</span>
                                <span>: A17 Pro, CPU 6-core, GPU 6-core</span>
                            </li>
                            <li class="flex">
                                <span class="font-medium text-gray-900 w-40 flex-shrink-0">• RAM</span>
                                <span>: 8GB</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Rental Form -->
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Form Pemesanan</h3>
                        <form id="rentalForm" class="space-y-4">
                            <!-- Start Date -->
                            <div>
                                <label for="startDate" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Mulai
                                </label>
                                <input type="date" id="startDate" name="startDate" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300" required>
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="endDate" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Kembali
                                </label>
                                <input type="date" id="endDate" name="endDate" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300" required>
                            </div>

                            <!-- Total Price Display -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Durasi Sewa:</span>
                                    <span id="rentalDuration" class="text-sm font-semibold text-gray-800">0 hari</span>
                                </div>
                                <div class="flex justify-between items-center text-lg font-semibold">
                                    <span>Total Biaya Sewa:</span>
                                    <span id="totalPrice" class="text-gray-800">Rp 0</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <button type="submit" class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Sewa Sekarang
                                </button>
                                <button type="button" onclick="goToDaftarIphone()" class="w-full bg-transparent text-gray-800 py-3 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-all duration-300">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali ke Daftar iPhone
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('startDate').setAttribute('min', today);
        document.getElementById('startDate').value = today;

        // Calculate rental duration and price
        function calculateRental() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                
                // Calculate difference in days
                const timeDiff = end.getTime() - start.getTime();
                const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                
                if (daysDiff > 0) {
                    const pricePerDay = 50000;
                    const totalPrice = daysDiff * pricePerDay;
                    
                    document.getElementById('rentalDuration').textContent = `${daysDiff} hari`;
                    document.getElementById('totalPrice').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                } else {
                    document.getElementById('rentalDuration').textContent = '0 hari';
                    document.getElementById('totalPrice').textContent = 'Rp 0';
                }
            } else {
                document.getElementById('rentalDuration').textContent = '0 hari';
                document.getElementById('totalPrice').textContent = 'Rp 0';
            }
        }

        // Set minimum end date when start date changes
        document.getElementById('startDate').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('endDate');
            
            // Set minimum end date to the day after start date
            if (startDate) {
                const minEndDate = new Date(startDate);
                minEndDate.setDate(minEndDate.getDate() + 1);
                endDateInput.setAttribute('min', minEndDate.toISOString().split('T')[0]);
                
                // Clear end date if it's before the new minimum
                if (endDateInput.value && new Date(endDateInput.value) <= new Date(startDate)) {
                    endDateInput.value = '';
                }
            }
            
            calculateRental();
        });

        // Calculate when end date changes
        document.getElementById('endDate').addEventListener('change', calculateRental);

        // Image gallery functionality
        function changeImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc;
            
            // Update thumbnail borders
            document.querySelectorAll('.aspect-square').forEach(thumb => {
                thumb.classList.remove('border-gray-800');
                thumb.classList.add('border-gray-200');
            });
            
            event.currentTarget.classList.add('border-gray-800');
            event.currentTarget.classList.remove('border-gray-200');
        }

        // Form submission
        document.getElementById('rentalForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const duration = document.getElementById('rentalDuration').textContent;
            const totalPrice = document.getElementById('totalPrice').textContent;
            
            if (!startDate || !endDate) {
                alert('Mohon lengkapi tanggal mulai dan tanggal kembali');
                return;
            }
            
            if (new Date(endDate) <= new Date(startDate)) {
                alert('Tanggal kembali harus setelah tanggal mulai');
                return;
            }
            
            alert(`Detail Pemesanan:\n\nProduk: iPhone 15 Pro Max 256GB\nTanggal Mulai: ${startDate}\nTanggal Kembali: ${endDate}\nDurasi: ${duration}\nTotal: ${totalPrice}\n\nAkan redirect ke halaman checkout - integrasi dengan Laravel`);
        
            // In real implementation, redirect to checkout
            window.location.href = 'pembayaran.html';
        });

        // Initialize calculation
        calculateRental();
 </script>
@endpush


