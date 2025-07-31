@extends('layouts.admin')

@section('title', 'Beranda')

@section('content')
    <!-- Login Section -->
    <section class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-6">
                    <i class="fas fa-mobile-alt text-3xl text-gray-800"></i>
                    <span class="text-3xl font-bold text-gray-800">iRentalKita</span>
                </div>
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-medium mb-4 inline-block">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Admin Portal
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Login Admin</h2>
                <p class="text-gray-600">Masuk ke dashboard admin untuk mengelola sistem</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="mt-8 space-y-6 bg-white p-8 rounded-2xl shadow-lg border-2 border-red-200">
                <div class="space-y-4">
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username Admin
                        </label>
                        <div class="relative">
                            <input 
                                id="username" 
                                name="username" 
                                type="text" 
                                required 
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan username admin"
                            >
                            <i class="fas fa-user-shield absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <span id="usernameError" class="text-red-500 text-sm hidden">Username tidak boleh kosong</span>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="w-full pl-10 pr-12 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan password admin"
                            >
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button 
                                type="button" 
                                id="togglePassword" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        <span id="passwordError" class="text-red-500 text-sm hidden">Password minimal 6 karakter</span>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 mt-0.5"></i>
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium">Akses Terbatas</p>
                            <p>Halaman ini hanya untuk petugas admin yang berwenang.</p>
                        </div>
                    </div>
                </div>

                <!-- Login Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-red-600 hover:text-red-600 border-2 border-red-600 transition-all duration-300 flex items-center justify-center"
                        id="loginBtn"
                    >
                        <span id="loginText">Masuk ke Dashboard Admin</span>
                        <i id="loginSpinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                    </button>
                </div>

                <!-- Back Button -->
                <div>
                    <button 
                        type="button" 
                        onclick="goToLoginPenyewa()"
                        class="w-full bg-transparent text-gray-800 py-3 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-all duration-300 flex items-center justify-center"
                    >
                        <i class="fas fa-home mr-2"></i>
                        Kembali Ke Login Penyewa
                    </button>
                </div>

            </form>
        </div>
    </section>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Toggle password visibsility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });

        // Form validation
        const loginForm = document.getElementById('loginForm');
        const usernameInput = document.getElementById('username');
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');
        const loginBtn = document.getElementById('loginBtn');
        const loginText = document.getElementById('loginText');
        const loginSpinner = document.getElementById('loginSpinner');

        // Real-time validation
        usernameInput.addEventListener('blur', function() {
            if (this.value.length === 0) {
                usernameError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                usernameError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        passwordInput.addEventListener('blur', function() {
            if (this.value.length < 6) {
                passwordError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                passwordError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        // Form submission
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = usernameInput.value;
            const password = passwordInput.value;
            
            // Validate form
            let isValid = true;
            
            if (username.length === 0) {
                usernameError.classList.remove('hidden');
                usernameInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (password.length < 6) {
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (isValid) {
                // Show loading state
                loginText.textContent = 'Memverifikasi...';
                loginSpinner.classList.remove('hidden');
                loginBtn.disabled = true;
                loginBtn.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Simulate login process
                setTimeout(() => {
                    // Reset button state
                    loginText.textContent = 'Masuk ke Dashboard Admin';
                    loginSpinner.classList.add('hidden');
                    loginBtn.disabled = false;
                    loginBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    
                    // Demo credentials check
                    if (username === 'admin' && password === 'admin123') {
                        alert(`Login Admin Berhasil!\n\nUsername: ${username}\nRole: Administrator\n\nAkan redirect ke dashboard admin - integrasi dengan Laravel`);
                        
                        // In real implementation, redirect to admin dashboard
                        window.location.href = '/admin/dashboard-admin';
                    } else {
                        alert('Username atau password admin salah!\n\nDemo credentials:\nUsername: admin\nPassword: admin123');
                    }
                }, 800);
            }
        });

        // Clear errors on input
        usernameInput.addEventListener('input', function() {
            usernameError.classList.add('hidden');
            this.classList.remove('border-red-500');
        });

        passwordInput.addEventListener('input', function() {
            passwordError.classList.add('hidden');
            this.classList.remove('border-red-500');
        });

        // Auto-focus on username input
        window.addEventListener('load', function() {
            usernameInput.focus();
        });

        // Security logging (in real implementation)
        console.log('Admin login page accessed at:', new Date().toISOString());
 </script>
@endpush


