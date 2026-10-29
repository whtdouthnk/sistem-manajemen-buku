@include('layout.header')
        <h3>Detail Penerbit</h3>
        <table>
            <tbody>
                <td width="170px">Nama Penerbit</td>
                <td width="2px">:</td>
                 <td>{{ $penerbit->nama_penerbit }}</td>
            </tbody>
        </table>
       
@include('layout.footer')