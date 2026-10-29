@include('layout.header')

<h3 class="header-h3">Edit Anggota</h3>
<a href="{{ route('anggota.index') }}" class="btn-blue">Kembali</a>

<form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-bold mb-2">Nama Anggota</label>
        <input type="text" name="nama_anggota" 
               value="{{ old('nama_anggota', $anggota->nama_anggota) }}" 
               class="w-full px-3 py-2 border rounded @error('nama_anggota') border-red-500 @enderror">
        @error('nama_anggota')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Alamat</label>
        <input type="text" name="alamat" 
               value="{{ old('alamat', $anggota->alamat) }}" 
               class="w-full px-3 py-2 border rounded @error('alamat') border-red-500 @enderror">
        @error('alamat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">No Telepon</label>
        <input type="text" name="no_telpon" 
               value="{{ old('no_telpon', $anggota->no_telpon) }}" 
               class="w-full px-3 py-2 border rounded @error('no_telpon') border-red-500 @enderror">
        @error('no_telpon')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn-orange">Edit</button>
</form>

@include('layout.footer')
