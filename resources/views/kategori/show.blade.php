@include('layout.header')
        <h3 class="header-h3">Detail Kategori</h3>
        <table class="table1">
            <tbody>
                <td class="px-4 py-2" width="170px">Nama Kategori</td>
                <td class="px-4 py-2" width="2px">:</td>
                 <td class="px-4 py-2">{{ $kategori->nama_kategori }}</td>
            </tbody>
        </table>
       
@include('layout.footer')