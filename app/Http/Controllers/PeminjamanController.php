<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPeminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('allPeminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::all();
        $bukus = Buku::all();
        return view('peminjaman.create', compact('anggota', 'bukus'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valData = $request->validate([
            'tgl_peminjaman' => 'required|date',
            'anggota_id' => 'required',
            'buku_ids' => 'required|array',
            'buku_ids.*' => 'exists:bukus,id',
        ]);

        $peminjaman = Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'status_pengembalian' => 'Dipinjam',
        ]);

        $peminjaman->buku()->attach($request->buku_ids);
        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
{
    $peminjaman->load(['anggota', 'buku']);
    return view('peminjaman.show', compact('peminjaman'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate(['tgl_kembali'=>'date']);
        $peminjaman=Peminjaman::find($peminjaman->id);
        $peminjaman->update([
            'tgl_kembali' => $request->tgl_kembali,
            'status_pengembalian' => 'Dikembalikan',
        ]);
        return redirect()->route('peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    
public function destroy(Peminjaman $peminjaman)
{
    try {
        $peminjaman->delete();
        Alert::success('Sukses', 'Data peminjaman berhasil dihapus!');
    } catch (QueryException $e) {
        Alert::error('Gagal', 'Data tidak bisa dihapus karena masih terhubung dengan data lain!');
    }

    return redirect()->route('peminjaman.index');
}

}
