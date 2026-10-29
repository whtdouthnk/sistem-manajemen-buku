@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Peminjaman Buku</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->anggota->nama }}</td>
                <td>{{ $item->buku->judul }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->tanggal_kembali }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('laporan.cetak.pdf') }}" class="btn btn-danger">Cetak PDF</a>
    <a href="{{ route('laporan.cetak.excel') }}" class="btn btn-success">Cetak Excel</a>
</div>
@endsection
