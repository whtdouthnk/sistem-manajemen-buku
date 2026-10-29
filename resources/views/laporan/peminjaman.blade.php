@include('layout.header')

<div class="flex items-center justify-between mb-4">
    <h3>Laporan Peminjaman Buku</h3>
    <button onclick="window.print()" class="btn-blue">Cetak</button>
</div>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Anggota</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $p)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $p->tgl_peminjaman }}</td>
            <td>{{ $p->anggota->nama_anggota }}</td>
            <td>{{ $p->status_pengembalian }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
@media print {
    .btn-blue {
        display: none; /* tombol tidak ikut tercetak */
    }
}
</style>

@include('layout.footer')
