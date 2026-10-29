<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        if($query){
            $allBuku = Buku::with(['penerbit', 'kategori']) 
                ->when($query, function($queryBuilder) use($query){
                    $queryBuilder->where('judul', 'like', '%'.$query. '%')
                    ->orWhere('pengarang', 'like', '%'.$query. '%')
                    ->orWhere('tahun_terbit', 'like', '%'.$query. '%');
                })->paginate(7);
            $allBuku->appends(['q'=>$query]);
        }else{
            $allBuku = Buku::with(['penerbit', 'kategori']) 
                ->latest()->paginate(7);
        }
        return view('buku.index', compact('allBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        return view('buku.create', compact('penerbit','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:100',
            'pengarang' => 'required|max:100',
            'tahun_terbit' => 'required|integer|min:1000|max:'.(date('Y')+1),
            'kategori_id' => 'required|exists:kategoris,id',
            'penerbit_id' => 'required|exists:penerbits,id', 
            'deskripsi' => 'nullable|string',
            'file_cover' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
        ],[
            'judul.required' => 'Judul buku tidak boleh kosong!',
            'pengarang.required' => 'Pengarang tidak boleh kosong!',
            'tahun_terbit.required' => 'Tahun terbit tidak boleh kosong!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'penerbit_id.required' => 'Penerbit harus dipilih!',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid!',
            'penerbit_id.exists' => 'Penerbit yang dipilih tidak valid!',
        ]);

        if($request->hasFile('file_cover')){
            $validatedData['cover'] = $request->file('file_cover')->store('cover', 'public');
        }

        unset($validatedData['file_cover']);

        Buku::create($validatedData);
        Alert::success('Sukses','Data berhasil ditambahkan!');
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku) 
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku','penerbit','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku) 
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:100',
            'pengarang' => 'required|max:100',
            'tahun_terbit' => 'required|integer|min:1000|max:'.(date('Y')+1), 
            'kategori_id' => 'required|exists:kategoris,id',
            'penerbit_id' => 'required|exists:penerbits,id',
            'deskripsi' => 'nullable|string',
            'file_cover' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
        ],[
            'judul.required' => 'Judul buku tidak boleh kosong!',
            'pengarang.required' => 'Pengarang tidak boleh kosong!',
            'tahun_terbit.required' => 'Tahun terbit tidak boleh kosong!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'penerbit_id.required' => 'Penerbit harus dipilih!',
        ]);

        if($request->hasFile('file_cover')){
            $validatedData['cover'] = $request->file('file_cover')->store('cover', 'public');

            if($buku->cover && Storage::exists('public/' . $buku->cover)){
                Storage::delete('public/' . $buku->cover);
            }
        }

        unset($validatedData['file_cover']);

        $buku->update($validatedData);
        Alert::success('Sukses', 'Data berhasil diubah!');

        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku) 
    {
        if($buku->cover && Storage::exists('public/'.$buku->cover)){
            Storage::delete('public/'. $buku->cover);
        }
        
        $buku->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!');

        return redirect()->route('buku.index');
    }

public function uploadImage(Request $request)
{
    if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        $request->file('upload')->move(public_path('images'), $fileName);

        $url = asset('images/' . $fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    }
}
public function laporan()
{
    $allBuku = Buku::with(['penerbit', 'kategori'])->get();

    return view('buku.laporan', compact('allBuku'));
}
}