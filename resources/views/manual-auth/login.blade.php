<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - LibraryMu</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
        
        .input-group {
            transition: all 0.3s ease;
        }
        
        .input-group:focus-within {
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .floating-label {
            transition: all 0.3s ease;
        }
        
        .input-field:focus + .floating-label,
        .input-field:not(:placeholder-shown) + .floating-label {
            transform: translateY(-24px) scale(0.85);
            color: #667eea;
            font-weight: 500;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-32 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: -4s;"></div>
    </div>

    <!-- Main Login Card -->
    <div class="login-card rounded-2xl w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center pt-8 pb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 text-white mb-4 shadow-lg">
                <i class="fas fa-book-open text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
            <p class="text-gray-600">Masuk ke akun LibraryMu Anda</p>
        </div>

        <!-- Login Form -->
        <div class="px-8 pb-8">
            @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 flex items-center gap-3 animate-pulse">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                <div class="flex items-center gap-2 text-red-700 mb-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="font-medium">Terjadi kesalahan:</span>
                </div>
                <ul class="text-sm text-red-600 list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('loginProses') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Input -->
                <div class="input-group">
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder=" "
                               class="input-field w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition duration-200 outline-none bg-white/50">
                        <label class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                            <i class="fas fa-envelope mr-2"></i>Alamat Email
                        </label>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="input-group">
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               placeholder=" "
                               class="input-field w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition duration-200 outline-none bg-white/50 pr-12">
                        <label class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                            <i class="fas fa-lock mr-2"></i>Kata Sandi
                        </label>
                        <button type="button" class="absolute right-4 top-4 text-gray-400 hover:text-gray-600 transition" onclick="togglePassword()">
                            <i class="fas fa-eye" id="password-toggle"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="text-purple-600 hover:text-purple-700 font-medium transition">
                        Lupa kata sandi?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login w-full py-4 rounded-xl text-white font-semibold text-lg shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Akun
                </button>
            </form>

            <!-- Back to Homepage -->
            <div class="mt-8 text-center">
                <a href="{{ route('homepage') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-purple-600 transition font-medium">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-500">
                    &copy; 2025 LibraryMu. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    @include('sweetalert::alert')

    <script>
        function togglePassword() {
            const passwordField = document.querySelector('input[name="password"]');
            const toggleIcon = document.getElementById('password-toggle');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        // Add floating animation to inputs on focus
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('transform', '-translate-y-1');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('transform', '-translate-y-1');
            });
        });

        // Auto-hide error messages after 5 seconds
        setTimeout(() => {
            const errorDivs = document.querySelectorAll('.bg-red-50');
            errorDivs.forEach(div => {
                div.style.opacity = '0';
                div.style.transition = 'opacity 0.5s ease';
                setTimeout(() => div.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>