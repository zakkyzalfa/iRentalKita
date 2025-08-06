@extends('layouts.app')

@section('title', 'Login Penyewa')

@section('content')
<section class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <i class="fas fa-mobile-alt text-4xl text-gray-800"></i>
                <span class="text-4xl font-bold text-gray-800">iRentalKita</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h2>
            <p class="text-gray-600 text-lg">Silakan masuk untuk melanjutkan rental iPhone</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('penyewa.login') }}" class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            @csrf
            <div class="space-y-5">
                <!-- Email Field -->
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

                <!-- Password Field -->
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
            </div>

            <!-- Login Button -->
            <div>
                <button 
                    type="submit"
                    class="w-full bg-gray-800 text-white py-3.5 px-4 rounded-lg font-semibold hover:bg-gray-700 transition-colors flex items-center justify-center"
                    id="loginBtn"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
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

            <!-- Register Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('pendaftaran') }}" class="text-gray-800 hover:text-gray-600 font-medium transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </form>

        <!-- Login Admin -->
        <div class="bg-red-100 border-2 border-red-300 rounded-xl p-4 mt-6 text-center">
            <p class="text-gray-800">
                (Hanya untuk petugas) 
                <a href="/login-admin" class="text-red-500 hover:text-red-800 font-medium transition-colors">
                    Login Sebagai Admin
                </a>
            </p>
        </div>
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
    });
</script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Masuk',
            text: '{{ session('success') }}',
            confirmButtonText: 'Oke',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('home') }}";
            }
        });
    </script>
@endif
@if ($errors->has('email'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ $errors->first('email') }}',
            confirmButtonText: 'Oke',
        });
    </script>
@endif
@endpush
