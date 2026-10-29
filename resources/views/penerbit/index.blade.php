@include('layout.header')
        <h3 class="header-h3">Penerbit</h3>
        <a href="{{ route('penerbit.create') }}" class="btn-blue">Tambah</a>
        <table class="table1">
            <thead>
                <tr>
                    <th class="custom_th">NO</th>
                    <th class="custom_th">NAMA PENERBIT</th>
                    <th class="custom_th">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allPenerbit as $key => $r)
                    <tr>
                        <td class="custom_td" width="50">{{ $key+1 }}</td>
                        <td class="custom_td">{{ $r->nama_penerbit }}</td>
                        <td class="custom_td" width="210">
                            <form action="{{ route('penerbit.destroy', $r->id) }}" method="POST">
                                {{-- <a href="{{ route('penerbit.show', $r->id) }}" class="btn-green">Detail</a> --}}
                                <a href="{{ route('penerbit.edit', $r->id) }}" class="btn-orange">Edit</a>
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