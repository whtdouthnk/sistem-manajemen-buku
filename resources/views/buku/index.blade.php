@include('layout.header')
        <h3 class="header-h3">Buku</h3>
        <div style="display: flex; justify-content:space-between;align-items:center;">
            <div>
                <a href="{{ route('buku.create') }}" class="btn-blue">Tambah</a>
                <a href="{{ route('buku.laporan') }}" class="btn-green">Laporan</a>
            </div>
        
            <form class="flex items-center" action="{{ route('buku.index') }}" method="get">
                <input type="text" name="q" class="w-full px-3 py-1 border border-gray-300 rounded" placeholder="Cari judul/pengarang/tahun">
                <button type="submit" class="btn-blue ml-2">Cari</button>
            </form>
        </div>
        <table class="table1">
            <thead>
                <tr>
                    <th class="custom_th">NO</th>
                    <th class="custom_th">COVER</th>
                    <th class="custom_th">JUDUL</th>
                    <th class="custom_th">PENGARANG</th>
                    <th class="custom_th">TAHUN</th>
                    <th class="custom_th">PENERBIT</th>
                    <th class="custom_th">KATEGORI</th>
                    <th class="custom_th" width="170px">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allBuku as $key => $r)
                    <tr>
                        <td class="custom_td" width="50">{{ $key+$allBuku->firstItem() }}</td>
                        <td class="custom_td">
                            @if ($r->cover)
                            <img src="{{ asset('storage/' . $r->cover) }}" alt="cover" width="80">
                                
                            @endif
                        </td>
                        <td class="custom_td">{{ $r->judul }}</td>
                        <td class="custom_td">{{ $r->pengarang }}</td>
                        <td class="custom_td">{{ $r->tahun_terbit }}</td>
                        <td class="custom_td">{{ $r->penerbit->nama_penerbit }}</td>
                        <td class="custom_td">{{ $r->kategori->nama_kategori }}</td>
                        <td class="custom_td" width="210">
                            <form action="{{ route('buku.destroy', $r->id) }}" method="POST">
                                {{-- <a href="{{ route('buku.show', $r->id) }}" class="btn-green">Detail</a> --}}
                                <a href="{{ route('buku.edit', $r->id) }}" class="btn-orange">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-red">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination mt-4">
            {{-- {{ $allBuku->links('vendor.pagination.buatanku') }} --}}
            {{ $allBuku->links('vendor.pagination.tailwind') }}
        </div>
@include('layout.footer')