@include('layout.header')

<div class="flex items-center justify-between">
    <h3 class="header-h3">Detail Peminjaman</h3>
    <a href="{{ route('peminjaman.index') }}" class="btn-abu">Kembali</a>
</div>

<div class="mb-4 border p-4">
    <p><strong>Tanggal Peminjaman: </strong>{{ $peminjaman->tgl_peminjaman }}</p>
    <p><strong>Nama Anggota: </strong>{{ $peminjaman->anggota->nama_anggota }}</p>
    <p><strong>Status Pengembalian: </strong>{{ $peminjaman->status_pengembalian }}</p>
</div>

<div class="overflow-x-auto">
    <table class="table1">
        <thead>
            <tr class="bg-gray-100">
                <th class="custom_th">No</th>
                <th class="custom_th">Judul Buku</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($peminjaman->buku as $key=>$buku)
                <tr>
                    <td class="custom_td">{{ $key + 1 }}</td>
                    <td class="custom_td">{{ $buku->judul }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if ($peminjaman->status_pengembalian == 'Dipinjam')
    <div class="my-4 border p-4">
        <h3 class="header-h3">Pengembalia</h3>
        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="block font-bold mb-2">Tanggal Pengembalian</label>
            <input type="date" name="tgl_kembali" id="" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded">
        </div>
        <button type="submit" class="btn-red">Proses Pengembalian</button>
        </form>
    </div>
@endif
@include('layout.footer')