@extends('layouts.app')

@section('title', 'Pendaftaran Penyewa')

@section('content')
<section class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <i class="fas fa-mobile-alt text-4xl text-gray-800"></i>
                <span class="text-4xl font-bold text-gray-800">iRentalKita</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Sebagai Penyewa</h2>
            <p class="text-gray-600 text-lg">Buat akun untuk mulai menyewa iPhone yang Anda inginkan</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('penyewa.register') }}" class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            @csrf
            <div class="space-y-5">
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                        <i class="fas fa-user-alt mr-2 text-gray-500"></i> Nama Lengkap
                    </label>
                    <input 
                        id="nama"
                        name="nama"
                        type="text"
                        required
                        value="{{ old('nama') }}"
                        class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan nama lengkap Anda"
                    >
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-envelope mr-2 text-gray-500"></i> Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan email Anda"
                    >
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-lock mr-2 text-gray-500"></i> Password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan password Anda"
                    >
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer top-8" id="togglePassword">
                        <i class="fas fa-eye text-gray-500"></i>
                    </span>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-gray-500"></i> Konfirmasi Password
                    </label>
                    <input 
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-gray-800 placeholder-gray-400"
                        placeholder="Konfirmasi password Anda"
                    >
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer top-8" id="toggleConfirmPassword">
                        <i class="fas fa-eye text-gray-500"></i>
                    </span>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i> Alamat
                    </label>
                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="3"
                        required
                        class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors resize-none text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan alamat lengkap Anda"
                    >{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-phone-alt mr-2 text-gray-500"></i> Nomor Telepon
                    </label>
                    <input 
                        id="no_hp"
                        name="no_hp"
                        type="text"
                        required
                        maxlength="15"
                        value="{{ old('no_hp') }}"
                        class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-gray-800 placeholder-gray-400"
                        placeholder="08xxxxxxxxxx"
                    >
                    @error('no_hp')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor KTP -->
                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-id-card mr-2 text-gray-500"></i> Nomor KTP
                    </label>
                    <input 
                        id="no_ktp"
                        name="no_ktp"
                        type="text"
                        required
                        maxlength="20"
                        value="{{ old('no_ktp') }}"
                        class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan nomor KTP"
                    >
                    @error('no_ktp')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Register Button -->
            <div>
                <button 
                    type="submit"
                    class="w-full bg-gray-800 text-white py-3.5 px-4 rounded-lg font-semibold hover:bg-gray-700 transition-colors flex items-center justify-center"
                    id="registerBtn"
                >
                    <i class="fas fa-user-plus mr-2"></i> Daftar
                </button>
            </div>

            <!-- Back to Home Button -->
            <div>
                <a 
                    href="{{ route('home') }}"
                    class="w-full block text-center bg-transparent text-gray-800 py-3.5 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-colors flex items-center justify-center"
                >
                    <i class="fas fa-home mr-2"></i> Kembali Ke Beranda
                </a>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login-penyewa') }}" class="text-gray-800 hover:text-gray-600 font-medium transition-colors">
                        Masuk sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        if (toggleConfirmPassword && confirmPasswordInput) {
            toggleConfirmPassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                
                // Toggle the eye icon
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    });
</script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonText: 'Oke',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login-penyewa') }}";
            }
        });
    </script>
@endif
@endpush
