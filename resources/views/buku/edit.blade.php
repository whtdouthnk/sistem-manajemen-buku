@include('layout.header')

<h3 class="header-h3">Edit Buku</h3>
<form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-bold mb-2" for="judul">Judul</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="judul" id="judul"
            value="{{ old('judul', $buku->judul) }}">
        @error('judul')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="pengarang">Pengarang</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="pengarang" id="pengarang"
            value="{{ old('pengarang', $buku->pengarang) }}">
        @error('pengarang')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="tahun_terbit">Tahun Terbit</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="tahun_terbit" id="tahun_terbit"
            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
        @error('tahun_terbit')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="penerbit_id">Penerbit</label>
        <select name="penerbit_id" id="penerbit_id"
            class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-700">
            @foreach ($penerbit as $p)
                <option value="{{ $p->id }}" {{ old('penerbit_id', $buku->penerbit_id) == $p->id ? 'selected' : '' }}>
                    {{ $p->nama_penerbit }}
                </option>
            @endforeach
        </select>
        @error('penerbit_id')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="kategori_id">Kategori</label>
        <select name="kategori_id" id="kategori_id"
            class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-700">
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}" {{ old('kategori_id', $buku->kategori_id) == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="file_cover">Cover Buku</label>
        <input type="file" name="file_cover" id="file_cover"
            class="w-full px-3 py-2 border border-gray-300 rounded bg-white">
        @if ($buku->cover)
            <p class="text-sm mt-2">Cover lama:</p>
            <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku" width="120" class="mt-1 mb-2 rounded shadow">
            <input type="hidden" name="cover_lama" value="{{ $buku->cover }}">
        @endif
        @error('file_cover')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
        @error('deskripsi')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-orange">Edit</button>
</form>

@include('layout.footer')
