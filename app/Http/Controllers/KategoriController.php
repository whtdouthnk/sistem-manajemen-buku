<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allKategori = Kategori::all();
        return view('kategori.index', compact('allKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:100',
        ], [
            'nama_kategori.required' => 'Nama Kategori tidak boleh kosong!',
        ]);

        Kategori::create($validatedData);
        Alert::success('Sukses', 'Data berhasil ditambahkan!');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:100',
        ], [
            'nama_kategori.required' => 'Nama Kategori tidak boleh kosong!',
        ]);

        $kategori->update($validatedData);
        Alert::success('Sukses', 'Data berhasil diubah!');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori)
{
    try {
        $kategori->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!');
    } catch (\Illuminate\Database\QueryException $e) {
        Alert::error('Gagal Menghapus', 'Kategori masih digunakan pada data buku!');
    }

    return redirect()->route('kategori.index');
}

}
