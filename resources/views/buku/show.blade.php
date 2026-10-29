@include('layout.header')
        <h3>Detail Buku</h3>
        @if ($buku->cover)
        <div style="text-align: center;">
            <img src="{{ asset('storage/'. $buku->cover) }}" alt="cover buku" width="200px">
        </div>
        @endif
        <table>
            <tbody>
                <tr>
                    <td width="170px">Nama Buku</td>
                    <td width="2px">:</td>
                    <td>{{ $buku->judul }}</td>
                </tr>
                <tr>
                    <td width="170px">Pengarang</td>
                    <td width="2px">:</td>
                    <td>{{ $buku->pengarang }}</td>
                </tr>
                <tr>
                    <td width="170px">Tahun Terbit</td>
                    <td width="2px">:</td>
                    <td>{{ $buku->tahun_terbit }}</td>
                </tr>
                <tr>
                    <td width="170px">Penerbit</td>
                    <td width="2px">:</td>
                    <td>{{ $buku->penerbit->nama_penerbit }}</td>
                </tr>
                <tr>
                    <td width="170px">Kategori</td>
                    <td width="2px">:</td>
                    <td>{{ $buku->kategori->nama_kategori }}</td>
                </tr>
                
                
            </tbody>
        </table>
       
@include('layout.footer')