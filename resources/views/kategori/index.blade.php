@include('layout.header')
        <h3 class="header-h3">Kategori</h3>
        <a href="{{ route('kategori.create') }}" class=btn-blue>Tambah</a>
        <table class="table1">
            <thead>
                <tr class="bg-gray-100">
                    <th class="custom_th">NO</th>
                    <th class="custom_th">NAMA KATEGORI</th>
                    <th class="custom_th">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allKategori as $key => $r)
                    <tr>
                        <td class="custom_td" width="50">{{ $key+1 }}</td>
                        <td class="custom_td">{{ $r->nama_kategori }}</td>
                        <td class="custom_td" width="210">
                            <form action="{{ route('kategori.destroy', $r->id) }}" method="POST">
                                {{-- <a href="{{ route('kategori.show', $r->id) }}" class="btn-green">Detail</a> --}}
                                <a href="{{ route('kategori.edit', $r->id) }}" class=btn-orange>Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=btn-red>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
       
@include('layout.footer')