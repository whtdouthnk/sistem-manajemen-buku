@extends('frontend.master')

@section('title', 'Katalog Buku - LibraryMu')

@section('breadcrumb', 'Katalog Buku')

@section('content')
    <header class="hero-gradient text-white py-12">
        <div class="container max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Katalog Buku</h1>
            <h2 class="text-5xl md:text-7xl font-bold mb-6 text-yellow-300">LibraryMu</h2>
            <p class="text-lg md:text-xl max-w-2xl mx-auto">Jelajahi berbagai koleksi buku dari berbagai genre dan penulis terbaik</p>
            
            <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ $totalBuku ?? '1,250' }}</p>
                    <p class="text-sm">Total Buku</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ $totalKategori ?? '24' }}</p>
                    <p class="text-sm">Kategori</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ $totalPenerbit ?? '58' }}</p>
                    <p class="text-sm">Penerbit</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                    <p class="text-2xl font-bold">{{ $bukuBaru ?? '32' }}</p>
                    <p class="text-sm">Buku Baru</p>
                </div>
            </div>
        </div>
    </header>

  
    <section class="container max-w-6xl mx-auto px-4 py-8 -mt-6 relative z-10">
        <div class="bg-white rounded-xl shadow-lg p-6 filter-section border border-blue-100">
            <!-- Filter section tetap sama seperti sebelumnya -->
            <form action="{{ route('homepage') }}" method="get" class="flex flex-col md:flex-row md:items-end gap-4">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                        <select name="penerbit" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Semua Penerbit</option>
                            @foreach ($penerbit as $p)
                                <option value="{{ $p->id }}" {{ request('penerbit') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_penerbit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <select name="tahun" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Semua Tahun</option>
                            @for ($i = date('Y'); $i >= 1990; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Buku</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                               placeholder="Judul, pengarang, atau kata kunci...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                        <i class="fas fa-search"></i>
                        <span>Cari</span>
                    </button>
                    <a href="{{ route('homepage') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                        <i class="fas fa-redo"></i>
                        <span class="hidden md:inline">Reset</span>
                    </a>
                </div>
            </form>
            @if(request()->hasAny(['kategori', 'penerbit', 'tahun', 'search']))
            <div class="mt-4 flex flex-wrap gap-2">
                <!-- Filter tags tetap sama -->
                @if(request('kategori'))
                    @php
                        $selectedKategori = $kategori->firstWhere('id', request('kategori'));
                    @endphp
                    @if($selectedKategori)
                    <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full flex items-center gap-1">
                        Kategori: {{ $selectedKategori->nama_kategori }}
                        <a href="{{ request()->fullUrlWithQuery(['kategori' => null]) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                @endif
                
                @if(request('penerbit'))
                    @php
                        $selectedPenerbit = $penerbit->firstWhere('id', request('penerbit'));
                    @endphp
                    @if($selectedPenerbit)
                    <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full flex items-center gap-1">
                        Penerbit: {{ $selectedPenerbit->nama_penerbit }}
                        <a href="{{ request()->fullUrlWithQuery(['penerbit' => null]) }}" class="text-green-600 hover:text-green-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                @endif
                
                @if(request('tahun'))
                    <span class="bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full flex items-center gap-1">
                        Tahun: {{ request('tahun') }}
                        <a href="{{ request()->fullUrlWithQuery(['tahun' => null]) }}" class="text-purple-600 hover:text-purple-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
                
                @if(request('search'))
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full flex items-center gap-1">
                        Pencarian: "{{ request('search') }}"
                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="text-yellow-600 hover:text-yellow-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- Section Koleksi Buku (tetap sama) -->
    <section class="container max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Koleksi Buku</h2>
                <p class="text-gray-600 mt-1">Menampilkan {{ $buku->count() }} dari {{ $buku->total() }} buku</p>
            </div>
            <div class="mt-4 md:mt-0">
                <select id="sort" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                    <option value="judul_asc">Judul (A-Z)</option>
                    <option value="judul_desc">Judul (Z-A)</option>
                    <option value="populer">Paling Populer</option>
                </select>
            </div>
        </div>
        
        @if($buku->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($buku as $b)
            <div class="bg-white rounded-xl shadow-md overflow-hidden book-card border border-gray-100">
                <div class="p-5 flex">
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 mr-4">
                        @if ($b->cover)
                            <img src="{{ asset('storage/'.$b->cover) }}" alt="Cover {{ $b->judul }}" 
                                 class="w-24 h-32 object-cover rounded-lg shadow-sm">
                        @else
                            <img src="{{ asset('img/coverbuku.webp') }}" alt="Cover default" 
                                 class="w-24 h-32 object-cover rounded-lg shadow-sm">
                        @endif
                    </div>
                    
                    <!-- Book Details -->
                    <div class="flex-1">
                        <a href="{{ route('detail-buku', $b->slug) }}" class="hover:text-blue-600 transition">
                            <h3 class="font-bold text-lg text-gray-800 line-clamp-2">{{ $b->judul }}</h3>
                        </a>
                        
                        <p class="text-gray-600 text-sm mt-1">oleh <span class="font-medium">{{ $b->pengarang }}</span></p>
                        
                        <div class="mt-3 space-y-1">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-building text-gray-400 mr-2 w-4"></i>
                                <span>{{ $b->penerbit->nama_penerbit }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2 w-4"></i>
                                <span>Tahun: {{ $b->tahun_terbit }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-layer-group text-gray-400 mr-2 w-4"></i>
                                <span>{{ $b->kategori->nama_kategori ?? 'Umum' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex justify-between">
                    <a href="{{ route('detail-buku', $b->slug) }}" 
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                         <i class="fas fa-eye"></i>
                         <span>Detail</span>
                     </a>
                    
                    @if($b->stok > 0)
                    <button class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center gap-1">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Pinjam</span>
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-10">
            {{ $buku->links() }}
        </div>
        
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                <i class="fas fa-book-open text-xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-700 mb-2">Tidak ada buku yang ditemukan</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-6">Coba ubah filter pencarian Anda atau <a href="{{ route('homepage') }}" class="text-blue-600 hover:text-blue-800 font-medium">reset filter</a> untuk melihat semua buku.</p>
            <a href="{{ route('homepage') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-redo"></i>
                <span>Reset Pencarian</span>
            </a>
        </div>
        @endif
    </section>
@endsection

@section('scripts')
<script>
    // Script untuk Bacaan Favorit (horizontal scroll)
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.favorite-books');
        const prevBtn = document.querySelector('.favorite-prev');
        const nextBtn = document.querySelector('.favorite-next');
        const bookWidth = 192 + 24; // 192px (w-48) + 24px (gap-6)
        let scrollPosition = 0;

        nextBtn.addEventListener('click', function() {
            const maxScroll = container.scrollWidth - container.parentElement.clientWidth;
            scrollPosition = Math.min(scrollPosition + bookWidth * 2, maxScroll);
            container.style.transform = `translateX(-${scrollPosition}px)`;
        });

        prevBtn.addEventListener('click', function() {
            scrollPosition = Math.max(scrollPosition - bookWidth * 2, 0);
            container.style.transform = `translateX(-${scrollPosition}px)`;
        });

        // Juga bisa digeser dengan mouse drag
        let isDragging = false;
        let startX;
        let scrollLeft;

        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - container.offsetLeft;
            scrollLeft = scrollPosition;
        });

        container.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        container.addEventListener('mouseup', () => {
            isDragging = false;
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2;
            const maxScroll = container.scrollWidth - container.parentElement.clientWidth;
            scrollPosition = Math.max(0, Math.min(scrollLeft - walk, maxScroll));
            container.style.transform = `translateX(-${scrollPosition}px)`;
        });

        // Script untuk sort (tetap sama)
        document.getElementById('sort').addEventListener('change', function() {
            console.log('Sort by:', this.value);
        });

        document.querySelectorAll('.add-to-cart, .add-to-favorites').forEach(button => {
            button.addEventListener('click', function() {
                const bookId = this.getAttribute('data-book-id');
                const action = this.getAttribute('data-action');
                
                console.log(`Book ${bookId} ${action} clicked`);
                const icon = this.querySelector('i');
                const originalClass = icon.className;
                
                if (action === 'cart') {
                    icon.className = 'fas fa-check';
                    this.classList.remove('text-green-600', 'hover:text-green-800');
                    this.classList.add('text-blue-600');
                    setTimeout(() => {
                        icon.className = originalClass;
                        this.classList.remove('text-blue-600');
                        this.classList.add('text-green-600', 'hover:text-green-800');
                    }, 1500);
                }
            });
        });
    });
</script>

<style>
.favorite-books-container {
    -webkit-overflow-scrolling: touch;
    cursor: grab;
}

.favorite-books-container:active {
    cursor: grabbing;
}

.favorite-books {
    will-change: transform;
}

/* Hide scrollbar but keep functionality */
.favorite-books-container::-webkit-scrollbar {
    display: none;
}

.favorite-books-container {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endsection