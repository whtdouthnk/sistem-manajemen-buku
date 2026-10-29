@extends('frontend.master')

@section('title', 'Detail Buku - ' . $buku->judul)

@section('breadcrumb', 'Detail Buku')

@section('content')
    <section class="container max-w-6xl mx-auto px-4 py-6">
        <div class="book-info-card bg-white">
            <div class="flex flex-col lg:flex-row gap-8 p-6">
                <div class="w-full lg:w-1/3 flex flex-col items-center">
                    <div class="w-64 h-80 rounded-xl overflow-hidden book-cover">
                        @if ($buku->cover)
                            <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover {{ $buku->judul }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('img/coverbuku.webp') }}" alt="Cover Default" 
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                    
                    {{-- Action Buttons --}}
                    {{-- <div class="mt-6 flex flex-col sm:flex-row gap-3 w-full max-w-64">
                        <button class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg font-medium flex items-center justify-center gap-2 hover:bg-blue-50 transition" id="favoriteBtn">
                            <i class="far fa-heart"></i>
                            <span>Favorit</span>
                        </button>
                    </div> --}}
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $buku->judul }}</h1>
                        <p class="text-xl text-gray-600">oleh <span class="font-semibold text-blue-700">{{ $buku->pengarang }}</span></p>
                        
                        <div class="flex items-center gap-2 mt-3">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-5 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            Informasi Buku
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="info-item">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-building text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Penerbit</p>
                                        <p class="font-medium text-gray-800">{{ $buku->penerbit->nama_penerbit }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-calendar-alt text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Tahun Terbit</p>
                                        <p class="font-medium text-gray-800">{{ $buku->tahun_terbit }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-layer-group text-purple-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Kategori</p>
                                        <p class="font-medium text-gray-800">{{ $buku->kategori->nama_kategori }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-align-left text-blue-600"></i>
                            Deskripsi Buku
                        </h3>
                        <div class="bg-gray-50 rounded-xl p-5">
                            <div class="text-gray-700 leading-relaxed prose max-w-none">
                                @if($buku->deskripsi)
                                    {!! $buku->deskripsi !!}
                                @else
                                    <p class="text-gray-500 italic">Deskripsi tidak tersedia untuk buku ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl border border-blue-200">
                        <a href="{{ route('homepage') }}" 
                           class="flex items-center gap-2 px-4 py-2 text-blue-600 hover:text-blue-800 font-medium transition">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Katalog</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-book-open text-blue-600"></i>
                Buku Rekomendasi
            </h2>
            
            @if($relatedBooks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedBooks as $relatedBook)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="p-4 flex items-center gap-4">
                        <div class="flex-shrink-0">
                            @if($relatedBook->cover)
                                <img src="{{ asset('storage/' . $relatedBook->cover) }}" alt="{{ $relatedBook->judul }}" 
                                     class="w-16 h-20 object-cover rounded-lg">
                            @else
                                <img src="{{ asset('img/coverbuku.webp') }}" alt="{{ $relatedBook->judul }}" 
                                     class="w-16 h-20 object-cover rounded-lg">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('detail-buku', $relatedBook->slug) }}" class="hover:text-blue-600 transition">
                                <h4 class="font-semibold text-gray-800 line-clamp-2 mb-1">{{ $relatedBook->judul }}</h4>
                            </a>
                            <p class="text-sm text-gray-600 line-clamp-1">{{ $relatedBook->pengarang }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $relatedBook->kategori->nama_kategori }}</span>
                                <span class="text-xs text-gray-500">{{ $relatedBook->tahun_terbit }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8 bg-gray-50 rounded-xl">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Belum ada buku serupa</h3>
                <p class="text-gray-500">Tidak ditemukan buku lain dalam kategori yang sama.</p>
            </div>
            @endif
        </div>
    </section>
@endsection

@section('styles')
<style>
.prose {
    line-height: 1.6;
    font-family: inherit;
}

.prose h1, .prose h2, .prose h3, .prose h4 {
    margin-top: 1.5em;
    margin-bottom: 0.5em;
    font-weight: bold;
    color: #1f2937;
}

.prose h1 { font-size: 1.875rem; }
.prose h2 { font-size: 1.5rem; }
.prose h3 { font-size: 1.25rem; }
.prose h4 { font-size: 1.125rem; }

.prose p {
    margin-bottom: 1em;
}

.prose ul, .prose ol {
    margin-bottom: 1em;
    padding-left: 1.625em;
}

.prose ul {
    list-style-type: disc;
}

.prose ol {
    list-style-type: decimal;
}

.prose li {
    margin-bottom: 0.5em;
}

.prose strong {
    font-weight: bold;
    color: #374151;
}

.prose em {
    font-style: italic;
}

.prose u {
    text-decoration: underline;
}

.prose blockquote {
    border-left: 4px solid #3b82f6;
    padding-left: 1em;
    margin: 1.5em 0;
    font-style: italic;
    color: #6b7280;
}

/* Line clamp utilities */
.line-clamp-1 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
}

.line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const favoriteBtn = document.getElementById('favoriteBtn');
        if (favoriteBtn) {
            favoriteBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('far')) {
                    icon.className = 'fas fa-heart text-red-500';
                    this.classList.remove('border-blue-600', 'text-blue-600', 'hover:bg-blue-50');
                    this.classList.add('border-red-200', 'bg-red-50', 'text-red-600');
                    
                    showToast('Buku ditambahkan ke favorit');
                } else {
                    icon.className = 'far fa-heart';
                    this.classList.remove('border-red-200', 'bg-red-50', 'text-red-600');
                    this.classList.add('border-blue-600', 'text-blue-600', 'hover:bg-blue-50');
                    
                    showToast('Buku dihapus dari favorit');
                }
            });
        }
    });
    
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);
        
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
</script>
@endsection