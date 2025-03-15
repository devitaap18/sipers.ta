<?php

namespace App\Http\Controllers\BPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriAset;

class KategoriAsetController extends Controller
{
    public function index()
    {
        $kategori = KategoriAset::all();
        return view('bpo.kelola_aset', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_aset,nama',
            'kode' => 'required|unique:kategori_aset,kode',
        ]);

        KategoriAset::create($request->all());

        return redirect()->route('kelola_aset.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy($id)
    {
        KategoriAset::findOrFail($id)->delete();
        return redirect()->route('kelola_aset.index')->with('success', 'Kategori berhasil dihapus');
    }
}