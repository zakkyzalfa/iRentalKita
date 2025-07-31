@extends('layouts.app')

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
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h2>
                <p class="text-gray-600">Silakan masuk untuk melanjutkan rental iPhone</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" class="mt-8 space-y-6 bg-white p-8 rounded-2xl shadow-lg">
                <div class="space-y-4">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan email Anda"
                            >
                            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <span id="emailError" class="text-red-500 text-sm hidden">Email tidak valid</span>
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
                                class="w-full pl-10 pr-12 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan password Anda"
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

                <!-- Login Button -->
                <div>
                    <button 
                        type="submit" 
                        onclick="goToBeranda()"
                        class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300 flex items-center justify-center"
                        id="loginBtn"
                    >
                        <span id="loginText">Masuk</span>
                        <i id="loginSpinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                    </button>
                </div>

                <!-- Back to Home Button -->
                <div>
                    <button 
                        type="button" 
                        onclick="goToBeranda()"
                        class="w-full bg-transparent text-gray-800 py-3 px-4 rounded-lg font-semibold border-2 border-gray-800 hover:bg-gray-800 hover:text-white transition-all duration-300 flex items-center justify-center"
                    >
                        <i class="fas fa-home mr-2"></i>
                        Kembali Ke Beranda
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Belum punya akun? 
                        <a href="pendaftaran.html" class="text-gray-800 hover:text-gray-600 font-medium transition-colors">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </form>

            <!-- Login Admin -->
            <div class="bg-orange-50 border-2 border-orange-200 rounded-lg p-4 mt-6">
                <div class="text-center">
                    <p class="text-gray-600">
                        (Hanya untuk petugas) 
                        <a href="/login-admin" class="text-orange-800 hover:text-gray-600 font-medium transition-colors">
                            Login Sebagai Admin
                        </a>
                    </p>
                </div>
                </div>
            </div>
        
        </div>
    </section>
@endsection


@push('scripts')
<!-- <script src="/js/global.js"></script> -->
 <script>
        // Toggle password visibility
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
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const loginBtn = document.getElementById('loginBtn');
        const loginText = document.getElementById('loginText');
        const loginSpinner = document.getElementById('loginSpinner');

        // Email validation
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Real-time validation
        emailInput.addEventListener('blur', function() {
            if (!validateEmail(this.value)) {
                emailError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                emailError.classList.add('hidden');
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
            
            const email = emailInput.value;
            const password = passwordInput.value;
            
            // Validate form
            let isValid = true;
            
            if (!validateEmail(email)) {
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (password.length < 6) {
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (isValid) {
                // Show loading state
                loginText.textContent = 'Memproses...';
                loginSpinner.classList.remove('hidden');
                loginBtn.disabled = true;
                loginBtn.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Simulate login process
                setTimeout(() => {
                    // Reset button state
                    loginText.textContent = 'Masuk';
                    loginSpinner.classList.add('hidden');
                    loginBtn.disabled = false;
                    loginBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    
                    // Show SweetAlert2 success message
                    Swal.fire({
                        title: 'Login Berhasil!',
                        html: `Email: <strong>${email}</strong><br><br>Akan redirect ke dashboard - integrasi dengan Laravel`,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // In real implementation, redirect to dashboard
                        // window.location.href = 'dashboard.html';
                    });
                }, 2000);
            }
        });


        // Forgot password handler
        document.querySelector('a[href="#"]').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Fitur reset password akan diintegrasikan dengan Laravel');
        });

        // Auto-focus on email input
        window.addEventListener('load', function() {
            emailInput.focus();
        });

        // Clear errors on input
        emailInput.addEventListener('input', function() {
            emailError.classList.add('hidden');
            this.classList.remove('border-red-500');
        });

        passwordInput.addEventListener('input', function() {
            passwordError.classList.add('hidden');
            this.classList.remove('border-red-500');
        });
 </script>
@endpush


