@include('layout.header')
<h3 class="header-h3">Edit Kategori</h3>
<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block font-bold mb-2" for="">Nama Kategori</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="nama_kategori" id=""
            value="{{ $kategori->nama_kategori }}">
        @error('nama_kategori')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-orange">Edit</button>
</form>
@include('layout.footer')
