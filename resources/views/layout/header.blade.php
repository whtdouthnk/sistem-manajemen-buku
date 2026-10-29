<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi manajemen data buku</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        
        {{-- sidebar --}}
        <aside class="w-64 bg-gray-800 text-white flex flex-col fixed top-0 left-0 h-screen">

            {{-- <img src="{{ asset('assets/landing_page/nova/assets/img/logo/bookku.png') }}" alt="Logo" /> --}}
            <div class="p-4 text-center text-lg font-bold bg-gray-900">
                Panel Admin
            </div>
           <div class="flex justify-center items-center my-6">
    <a href="{{ route('homepage') }}"
       class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-medium px-5 py-2 rounded-xl shadow-md transition-all duration-200">
        <span class="material-icons">home</span>
        Ke Homepage
    </a>
</div>

            
            <nav class="flex-1">
                <ul class="space-y-2 p-4">
                    
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center p-2 rounded hover:bg-gray-700 {{ Request::routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                            <span class="material-icons">dashboard</span>
                            <span class="ml-3"> Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.index') }}"
                           class="flex items-center p-2 rounded hover:bg-gray-700 {{ Request::routeIs('kategori.*') ? 'bg-gray-700' : '' }}">
                            <span class="material-icons">folder</span>
                            <span class="ml-3"> Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penerbit.index') }}"
                           class="flex items-center p-2 rounded hover:bg-gray-700 {{ Request::routeIs('penerbit.*') ? 'bg-gray-700' : '' }}">
                            <span class="material-icons">newspaper</span>
                            <span class="ml-3"> Penerbit</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('buku.index') }}"
                           class="flex items-center p-2 rounded hover:bg-gray-700 {{ Request::routeIs('buku.*') ? 'bg-gray-700' : '' }}">
                            <span class="material-icons">menu_book</span>
                            <span class="ml-3"> Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('anggota.index') }}"
                           class="flex items-center p-2 rounded hover:bg-gray-700 {{ Request::routeIs('anggota.*') ? 'bg-gray-700' : '' }}">
                            <span class="material-icons">person</span>
                            <span class="ml-3"> Anggota</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peminjaman.index') }}"
                           class="flex items-center p-2 rounded hover:bg-gray-700 {{ Request::routeIs('peminjaman.*') ? 'bg-gray-700' : '' }}">
                            <span class="material-icons">library_books</span>
                            <span class="ml-3"> Peminjaman Buku</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            
            
                    @if (Auth::check())
                        <div class="p-4 text-center">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">Logout</button>
                            </form>
                        </div>
                    @endif
        </aside>


        {{-- konten-header --}}

        <div class="flex-1 flex flex-col ml-64">

            <header class="bg-white shadow flex items-center justify-between p-4">
                {{-- <h1 class="text-xl font-bold">Dashboard</h1> --}}
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button class="flex items-center focus:outline-none">
                            {{-- <img src="https://placehold.co/" alt="Profil" class="w-10 h-1o rounded-full"> --}}
                            <span class="ml-2 text-gray-700 font-medium">Login Sebagai: <strong>{{ Auth::user()->name }}</strong></span>
                        </button>

                       
                    </div>
                </div>
            </header>


            {{-- main-content --}}
            <main class="flex-1 p-6">
                <div class="bg-white rounded shadow p-4">