@include('layout.header')

<h3 class="header-h3">Tambah Anggota</h3>

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block font-bold mb-2">Nama Anggota</label>
        <input
            type="text"
            name="nama_anggota"
            value="{{ old('nama_anggota') }}"
            class="w-full px-3 py-2 border rounded @error('nama_anggota') border-red-500 @enderror"
            placeholder="Masukkan nama anggota"
        >
        @error('nama_anggota')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Alamat</label>
        <input
            type="text"
            name="alamat"
            value="{{ old('alamat') }}"
            class="w-full px-3 py-2 border rounded @error('alamat') border-red-500 @enderror"
            placeholder="Masukkan alamat"
        >
        @error('alamat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">No Telepon</label>
        <input
            type="text"
            name="no_telpon"
            value="{{ old('no_telpon') }}"
            class="w-full px-3 py-2 border rounded @error('no_telpon') border-red-500 @enderror"
            placeholder="Masukkan no. telepon"
        >
        @error('no_telpon')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn-blue">Simpan</button>
</form>

@include('layout.footer')
