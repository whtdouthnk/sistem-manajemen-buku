<style>
    .laporan-container{
        width: 100%;
        overflow-x: auto;
        margin-top: 20px;
    }

    .laporan-title{
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1e293b;
    }

    .laporan-table{
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .laporan-table thead{
        background: #2563eb;
        color: white;
    }

    .laporan-table th{
        padding: 14px;
        text-align: left;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .laporan-table td{
        padding: 12px 14px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
        color: #334155;
    }

    .laporan-table tbody tr:nth-child(even){
        background: #f8fafc;
    }

    .laporan-table tbody tr:hover{
        background: #dbeafe;
        transition: 0.2s;
    }

    .btn-print{
        background: #2563eb;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        margin-top: 20px;
        transition: 0.2s;
    }

    .btn-print:hover{
        background: #1d4ed8;
    }

    @media print{
        .btn-print{
            display: none;
        }

        body{
            background: white;
        }

        .laporan-table{
            box-shadow: none;
        }
    }
</style>

<h2 class="laporan-title">Laporan Data Buku</h2>

<div class="laporan-container">
    <table class="laporan-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>JUDUL</th>
                <th>PENGARANG</th>
                <th>TAHUN</th>
                <th>PENERBIT</th>
                <th>KATEGORI</th>
            </tr>
        </thead>

        <tbody>
            @foreach($allBuku as $key => $r)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $r->judul }}</td>
                <td>{{ $r->pengarang }}</td>
                <td>{{ $r->tahun_terbit }}</td>
                <td>{{ $r->penerbit->nama_penerbit }}</td>
                <td>{{ $r->kategori->nama_kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button onclick="window.print()" class="btn-print">
        Cetak Laporan
    </button>
</div>