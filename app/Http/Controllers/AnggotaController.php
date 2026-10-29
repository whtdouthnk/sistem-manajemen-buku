<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class AnggotaController extends Controller
{
    public function index()
    {
        $allAnggota = Anggota::all();
        return view('anggota.index', compact('allAnggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $valData = $request->validate([
            'nama_anggota' => 'required|max:100',
            'alamat' => 'required|max:255',
            'no_telpon' => 'required|max:20',
        ], [
            'nama_anggota.required' => 'Nama anggota wajib diisi!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'no_telpon.required' => 'Nomor telepon harus diisi!',
        ]);

        Anggota::create($valData);
        Alert::success('Sukses', 'Data anggota berhasil ditambahkan!');
        return redirect()->route('anggota.index');
    }

    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $valData = $request->validate([
            'nama_anggota' => 'required|max:100',
            'alamat' => 'required|max:255',
            'no_telpon' => 'required|max:20',
        ], [
            'nama_anggota.required' => 'Nama anggota wajib diisi!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'no_telpon.required' => 'Nomor telepon harus diisi!',
        ]);

        $anggota->update($valData);
        Alert::success('Sukses', 'Data anggota berhasil diperbarui!');
        return redirect()->route('anggota.index');
    }

    public function destroy(Anggota $anggota)
{
    try {
        $anggota->delete();
        Alert::success('Sukses', 'Data anggota berhasil dihapus!');
    } catch (QueryException $e) {
        Alert::error('Gagal', 'Data tidak bisa dihapus karena masih digunakan di peminjaman!');
    }

    return redirect()->route('anggota.index');
}
}
