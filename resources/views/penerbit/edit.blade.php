@include('layout.header')
        <h3 class="header-h3">Edit Penerbit</h3>
        <form action="{{ route('penerbit.update', $penerbit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="">Nama Penerbit</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="nama_penerbit" id="" value="{{ $penerbit->nama_penerbit }}">
            </div>
        
            <button type="submit" class="btn-orange">Edit</button>
        </form>
@include('layout.footer')