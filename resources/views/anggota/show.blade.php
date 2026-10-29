@include('layout.header')
        <h3 class="header-h3">Detail Kategori</h3>
        <a href="{{ route('anggota.index') }}" class="btn-abu">Kembali</a>
        <table class="table1">
            <tbody>
                <tr>
                    <td width="150px" class="px-4 py-2">Nama Anggota</td>
                    <td width="2px" class="px-4 py-2">:</td>
                    <td class="px-4 py-2">{{ $anggota->nama_anggota }}</td>
                </tr>
                <tr>
                    <td width="150px" class="px-4 py-2">Alamat</td>
                    <td width="2px" class="px-4 py-2">:</td>
                    <td class="px-4 py-2">{{ $anggota->alamat }}</td>
                </tr>
                <tr>
                    <td width="150px" class="px-4 py-2">No Telepon</td>
                    <td width="2px" class="px-4 py-2">:</td>
                    <td class="px-4 py-2">{{ $anggota->no_telpon }}</td>
                </tr>
            </tbody>
        </table>
       
@include('layout.footer')