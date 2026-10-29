<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Homepage') - LibraryMu</title>
    
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
        }
        
        .book-detail-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        
        .btn-primary {
            background-color: #1e40af;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }
        
        .book-info-card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .book-cover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }
        
        .book-cover:hover {
            transform: scale(1.02);
        }
        
        .info-item {
            border-bottom: 1px solid #f1f5f9;
            padding: 12px 0;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .book-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        
        .filter-section {
            background: linear-gradient(to right, #f8fafc, #e2e8f0);
        }
        
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- Navbar --}}
    <nav class="book-detail-gradient text-white py-4 shadow-lg">
        <div class="container max-w-6xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('homepage') }}" class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-book"></i>
                LibraryMu
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg hover:bg-white/30 transition flex items-center gap-2">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500/20 backdrop-blur-sm rounded-lg hover:bg-red-500/30 transition flex items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg hover:bg-white/30 transition flex items-center gap-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-200">
        <div class="container max-w-6xl mx-auto px-4 py-3">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('homepage') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fas fa-home mr-2"></i>
                            Homepage
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">@yield('breadcrumb', 'Katalog Buku')</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-blue-800 text-white py-8 mt-12">
        <div class="container max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <i class="fas fa-book"></i>
                        LibraryMu
                    </h2>
                    <p class="text-gray-300 mt-1">Perpustakaan Digital Modern</p>
                </div>
                <div class="text-gray-300 text-sm">
                    <p>&copy; 2025 Lutpytiara. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>