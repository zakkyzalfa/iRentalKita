@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Register Section -->
    <section class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-6">
                    <i class="fas fa-mobile-alt text-3xl text-gray-800"></i>
                    <span class="text-3xl font-bold text-gray-800">iRentalKita</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Sebagai Penyewa</h2>
                <p class="text-gray-600">Buat akun untuk mulai menyewa iPhone impian Anda</p>
            </div>

            <!-- Register Form -->
            <form id="registerForm" class="mt-8 space-y-6 bg-white p-8 rounded-2xl shadow-lg">
                <div class="space-y-4">
                    <!-- Full Name Field -->
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <input 
                                id="fullName" 
                                name="fullName" 
                                type="text" 
                                required 
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan nama lengkap Anda"
                            >
                            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <span id="fullNameError" class="text-red-500 text-sm hidden">Nama lengkap minimal 3 karakter</span>
                    </div>

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

                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <div class="relative">
                            <input 
                                id="phone" 
                                name="phone" 
                                type="tel" 
                                required 
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300"
                                placeholder="08xxxxxxxxxx"
                            >
                            <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <span id="phoneError" class="text-red-500 text-sm hidden">Nomor telepon tidak valid</span>
                    </div>

                    <!-- Address Field -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <div class="relative">
                            <textarea 
                                id="address" 
                                name="address" 
                                required 
                                rows="3"
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300 resize-none"
                                placeholder="Masukkan alamat lengkap Anda"
                            ></textarea>
                            <i class="fas fa-map-marker-alt absolute left-3 top-4 text-gray-400"></i>
                        </div>
                        <span id="addressError" class="text-red-500 text-sm hidden">Alamat minimal 10 karakter</span>
                    </div>

                    <!-- KTP Number Field -->
                    <div>
                        <label for="ktpNumber" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor KTP
                        </label>
                        <div class="relative">
                            <input 
                                id="ktpNumber" 
                                name="ktpNumber" 
                                type="text" 
                                required 
                                maxlength="16"
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan 16 digit nomor KTP"
                            >
                            <i class="fas fa-id-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <span id="ktpNumberError" class="text-red-500 text-sm hidden">Nomor KTP harus 16 digit</span>
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
                        <span id="passwordError" class="text-red-500 text-sm hidden">Password minimal 8 karakter</span>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input 
                                id="confirmPassword" 
                                name="confirmPassword" 
                                type="password" 
                                required 
                                class="w-full pl-10 pr-12 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition-all duration-300"
                                placeholder="Konfirmasi password Anda"
                            >
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button 
                                type="button" 
                                id="toggleConfirmPassword" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <i class="fas fa-eye" id="confirmEyeIcon"></i>
                            </button>
                        </div>
                        <span id="confirmPasswordError" class="text-red-500 text-sm hidden">Password tidak cocok</span>
                    </div>
                </div>

                <!-- Register Button -->
                <div>
                    <button 
                        type="submit"
                        onclick="goToLoginPenyewa()"
                        class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-semibold hover:bg-transparent hover:border-2 hover:border-gray-800 hover:text-gray-800 border-2 border-gray-800 transition-all duration-300 flex items-center justify-center"
                        id="registerBtn"
                    >
                        <span id="registerText">Daftar</span>
                        <i id="registerSpinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
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

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Sudah punya akun? 
                        <a href="/login-penyewa" class="text-gray-800 hover:text-gray-600 font-medium transition-colors">
                            Masuk sekarang
                        </a>
                    </p>
                </div>
            </form>

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

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const confirmEyeIcon = document.getElementById('confirmEyeIcon');

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

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            
            if (type === 'password') {
                confirmEyeIcon.classList.remove('fa-eye-slash');
                confirmEyeIcon.classList.add('fa-eye');
            } else {
                confirmEyeIcon.classList.remove('fa-eye');
                confirmEyeIcon.classList.add('fa-eye-slash');
            }
        });

        // Form validation
        const registerForm = document.getElementById('registerForm');
        const fullNameInput = document.getElementById('fullName');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const addressInput = document.getElementById('address');
        const ktpNumberInput = document.getElementById('ktpNumber');
        
        const fullNameError = document.getElementById('fullNameError');
        const emailError = document.getElementById('emailError');
        const phoneError = document.getElementById('phoneError');
        const addressError = document.getElementById('addressError');
        const ktpNumberError = document.getElementById('ktpNumberError');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');
        
        const registerBtn = document.getElementById('registerBtn');
        const registerText = document.getElementById('registerText');
        const registerSpinner = document.getElementById('registerSpinner');

        // Validation functions
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePhone(phone) {
            const phoneRegex = /^08[0-9]{8,11}$/;
            return phoneRegex.test(phone);
        }

        function validateFullName(name) {
            return name.length >= 3;
        }

        function validateAddress(address) {
            return address.length >= 10;
        }

        function validateKtpNumber(ktp) {
            const ktpRegex = /^[0-9]{16}$/;
            return ktpRegex.test(ktp);
        }

        function validatePassword(password) {
            return password.length >= 8;
        }

        // Real-time validation
        fullNameInput.addEventListener('blur', function() {
            if (!validateFullName(this.value)) {
                fullNameError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                fullNameError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        emailInput.addEventListener('blur', function() {
            if (!validateEmail(this.value)) {
                emailError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                emailError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        phoneInput.addEventListener('blur', function() {
            if (!validatePhone(this.value)) {
                phoneError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                phoneError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        addressInput.addEventListener('blur', function() {
            if (!validateAddress(this.value)) {
                addressError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                addressError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        ktpNumberInput.addEventListener('blur', function() {
            if (!validateKtpNumber(this.value)) {
                ktpNumberError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                ktpNumberError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        // Only allow numbers for KTP
        ktpNumberInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        passwordInput.addEventListener('blur', function() {
            if (!validatePassword(this.value)) {
                passwordError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                passwordError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        confirmPasswordInput.addEventListener('blur', function() {
            if (this.value !== passwordInput.value) {
                confirmPasswordError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                confirmPasswordError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });

        // Clear errors on input
        [fullNameInput, emailInput, phoneInput, addressInput, ktpNumberInput, passwordInput, confirmPasswordInput].forEach(input => {
            input.addEventListener('input', function() {
                const errorId = this.id + 'Error';
                const errorElement = document.getElementById(errorId);
                if (errorElement) {
                    errorElement.classList.add('hidden');
                    this.classList.remove('border-red-500');
                }
            });
        });

        // Form submission
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fullName = fullNameInput.value;
            const email = emailInput.value;
            const phone = phoneInput.value;
            const address = addressInput.value;
            const ktpNumber = ktpNumberInput.value;
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            // Validate form
            let isValid = true;
            
            if (!validateFullName(fullName)) {
                fullNameError.classList.remove('hidden');
                fullNameInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!validateEmail(email)) {
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!validatePhone(phone)) {
                phoneError.classList.remove('hidden');
                phoneInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!validateAddress(address)) {
                addressError.classList.remove('hidden');
                addressInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!validateKtpNumber(ktpNumber)) {
                ktpNumberError.classList.remove('hidden');
                ktpNumberInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (!validatePassword(password)) {
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (password !== confirmPassword) {
                confirmPasswordError.classList.remove('hidden');
                confirmPasswordInput.classList.add('border-red-500');
                isValid = false;
            }
            
            if (isValid) {
                // Show loading state
                registerText.textContent = 'Memproses...';
                registerSpinner.classList.remove('hidden');
                registerBtn.disabled = true;
                registerBtn.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Simulate registration process
                setTimeout(() => {
                    // Reset button state
                    registerText.textContent = 'Daftar';
                    registerSpinner.classList.add('hidden');
                    registerBtn.disabled = false;
                    registerBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    
                    // Show success message and redirect
                    alert(`Pendaftaran berhasil!\nNama: ${fullName}\nEmail: ${email}\nTelepon: ${phone}\nAlamat: ${address}\nKTP: ${ktpNumber}\n\nAkan redirect ke halaman verifikasi - integrasi dengan Laravel`);
                    
                    // In real implementation, redirect to verification page
                    // window.location.href = 'verification.html';
                }, 2000);
            }
        });

        // Auto-focus on full name input
        window.addEventListener('load', function() {
            fullNameInput.focus();
        });
 </script>
@endpush


