<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FBukuController extends Controller
{
    public function beranda()
    {
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        
        $bukuBaru = Buku::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        $bukuTerbaru = Buku::with(['kategori', 'penerbit'])
                          ->latest()
                          ->take(6)
                          ->get();

        return view('frontend.beranda', compact(
            'totalBuku',
            'totalKategori', 
            'totalPenerbit',
            'bukuBaru',
            'bukuTerbaru'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();
        
        $buku = Buku::with(['penerbit', 'kategori'])
                    ->when($request->kategori, function($query) use ($request) {
                        $query->where('kategori_id', $request->kategori);
                    })
                    ->when($request->penerbit, function($query) use ($request) {
                        $query->where('penerbit_id', $request->penerbit);
                    })
                    ->when($request->tahun, function($query) use ($request) {
                        $query->where('tahun_terbit', $request->tahun);
                    })
                    ->when($request->search, function($query) use ($request) {
                        $query->where('judul', 'like', '%'.$request->search.'%')
                              ->orWhere('pengarang', 'like', '%'.$request->search.'%');
                    })
                    ->latest()
                    ->paginate(12);

        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $bukuBaru = Buku::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        return view('frontend.index', compact(
            'buku', 
            'kategori', 
            'penerbit',
            'totalBuku',
            'totalKategori',
            'totalPenerbit',
            'bukuBaru'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
{
    // Convert slug back to original judul
    $originalJudul = str_replace('-', ' ', $slug);
    
    $buku = Buku::with(['penerbit', 'kategori'])
                ->where('judul', $originalJudul)
                ->firstOrFail();
    
    $relatedBooks = Buku::with(['penerbit', 'kategori'])
                        ->where('kategori_id', $buku->kategori_id)
                        ->where('id', '!=', $buku->id) 
                        ->inRandomOrder()
                        ->limit(6)
                        ->get();
    
    if ($relatedBooks->count() < 3) {
        $additionalBooks = Buku::with(['penerbit', 'kategori'])
                             ->where('id', '!=', $buku->id)
                             ->whereNotIn('id', $relatedBooks->pluck('id'))
                             ->inRandomOrder()
                             ->limit(3 - $relatedBooks->count())
                             ->get();
        
        $relatedBooks = $relatedBooks->merge($additionalBooks);
    }

    return view('frontend.detail_buku', compact('buku', 'relatedBooks'));
}
}