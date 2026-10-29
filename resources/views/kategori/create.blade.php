@include('layout.header')
        <h3 class="header-h3">Tambah Kategori</h3>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-bold mb-2" for="">Nama Kategori</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="nama_kategori" id="" placeholder="masukkan nama kategori">
                @error('nama_kategori')
                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="btn-blue">Simpan</button>
        </form>
@include('layout.footer')