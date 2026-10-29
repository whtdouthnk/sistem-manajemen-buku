<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Anggota;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data =[
            'jmlKategori' => Kategori::count(),
            'jmlPenerbit' => Penerbit::count(),
            'jmlSemuaBuku' => Buku::count(),
            'jmlAnggota' => Anggota::count(),
        ];
        $kategori = Kategori::withCount('bukus')->get();
        $namaKategori = $kategori->pluck('nama_kategori')->toArray();
        $jumlahBuku = $kategori->pluck('bukus_count')->toArray();
        $penerbit = Penerbit::withCount('bukus')->get();
        $namaPenerbit = $penerbit->pluck('nama_penerbit')->toArray();
        $JumlahBukuPenerbit = $penerbit->pluck('bukus_count')->toArray();

        return view('welcome', compact('data', 'namaKategori', 'jumlahBuku', 'namaPenerbit', 'JumlahBukuPenerbit'));

    }

   

}


