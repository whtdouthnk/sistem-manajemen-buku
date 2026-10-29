@include('layout.header')


<h3 class="header-h3">Halaman Dashboard</h3>

<section class="container mx-auto mb-8">
    
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white shadow rounded p-6 text-center border border-blue-500">
            <h2 class="text-xl font-bold text-gray-800">Total Kategori</h2>
            <p class="text-4xl font-extrabold text-blue-800">{{ $data['jmlKategori'] }}</p>
        </div>

        <div class="bg-white shadow rounded p-6 text-center border border-blue-500">
            <h2 class="text-xl font-bold text-gray-800">Total Penerbit</h2>
            <p class="text-4xl font-extrabold text-blue-800">{{ $data['jmlPenerbit'] }}</p>
        </div>


        <div class="bg-white shadow rounded p-6 text-center border border-blue-500">
            <h2 class="text-xl font-bold text-gray-800">Total Buku</h2>
            <p class="text-4xl font-extrabold text-blue-800">{{ $data['jmlSemuaBuku'] }}</p>
        </div>

        <div class="bg-white shadow rounded p-6 text-center border border-blue-500">
            <h2 class="text-xl font-bold text-gray-800">Total Anggota</h2>
            <p class="text-4xl font-extrabold text-blue-800">{{ $data['jmlAnggota'] }}</p>
        </div>
    </div>
</section>

<section class="container mx-auto mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Buku Per Kategori</h2>
    <canvas id="grafikBukuKategori" width="400" height="100"></canvas>
</section>
<script>
    const ctx = document.getElementById('grafikBukuKategori');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($namaKategori) !!},
            datasets: [{
                label: 'Jumlah Buku',
                data: {!! json_encode($jumlahBuku) !!},
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>








<section class="container mx-auto mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Buku Per Penerbit</h2>
    <canvas id="grafikBukuPenerbit" width="400" height="100"></canvas>
</section>
<script>
    const ctxPenerbit = document.getElementById('grafikBukuPenerbit');

    new Chart(ctxPenerbit, {
        type: 'bar',
        data: {
            labels: {!! json_encode($namaPenerbit) !!},
            datasets: [{
                label: 'Jumlah Buku',
                data: {!! json_encode($JumlahBukuPenerbit) !!},
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@include('layout.footer')
