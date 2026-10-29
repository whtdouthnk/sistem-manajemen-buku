@include('layout.header')

<div class="flex items-center justify-between">
    <h3 class="header-h3">Peminjaman Buku</h3>
    <a href="{{ route('peminjaman.create') }}" class="btn-blue">pinjam</a>
</div>

<table class="table1">
    <thead>
        <tr class="bg-gray-100">
            <th class="custom_th">NO</th>
            <th class="custom_th">TANGGAL</th>
            <th class="custom_th">NAMA ANGGOTA</th>
            <th class="custom_th">STATUS PENGEMBALIAN</th>
            <th class="custom_th">AKSI</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allPeminjaman as $key => $r)
            <tr>
                <td class="custom_td" width="50">{{ $key + 1 }}</td>
                <td class="custom_td">{{ $r->tgl_peminjaman }}</td>
                <td class="custom_td">{{ $r->anggota->nama_anggota }}</td>
                <td class="custom_td">{{ $r->status_pengembalian }}</td>
                <td class="custom_td">
                    <form action="{{ route('peminjaman.destroy', $r->id) }}" method="POST">
                        <a href="{{ route('peminjaman.show', $r->id) }}" class="btn-green">Detail</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-red">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('layout.footer')
