<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h3>Laporan Peminjaman Buku</h3>
    <table>
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
</body>
</html>
