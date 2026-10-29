@include('layout.header')


<h3 class="header-h3">Proses Peminjaman</h3>
<form action="{{ route('peminjaman.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="block font-bold mb-2">Tanggal Peminjaman</label>
        <input type="date" name="tgl_peminjaman" class="w-full px-3 py-2 border border-gray-300 rounded" value="{{ date('Y-m-d') }}">
    </div>
    <div class="mb-3">
        <label for="" class="block font-bold mb-2">Pilih Anggota</label>
        <select name="anggota_id" id="" class="w-full px-3 py-2 border border-gray-300 rounded">
            @foreach ($anggota as $a)
                <option value="{{ $a->id }}">{{ $a->nama_anggota }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <h3 class="header-h3">Katalog Buku</h3>
        <div class="overflow-y-scroll h-64 border border-gray-300 p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($bukus as $buku)
                    <div class="flex flex-col items-center p-4 border rounded-sm shadow-sm">
                        @if ($buku->cover)
                            <img src="{{ asset('storage').'/'.$buku->cover }}" alt="cover" class="w-16 h-20 object-cover mb-2">
                        @else
                            <img src="{{ asset('img/coverbuku.webp') }}" alt="cover" class="w-16 h-20 object-cover mb-2">
                        @endif

                        <div class="flex items-center">
                            <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}" class="form-checkbox">
                            <span class="text-sm text-center">{{ $buku->judul }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <button class="btn-blue" type="submit">
        Simpan Peminjaman
    </button>

</form>

@include('layout.footer')
