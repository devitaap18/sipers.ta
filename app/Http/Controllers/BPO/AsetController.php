<?php

namespace App\Http\Controllers\BPO;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\KategoriAset;
use App\Http\Controllers\Controller;

class AsetController extends Controller {
    public function index() {
        $kategori = KategoriAset::all();
        $asets = Aset::with('kategori')->get();
        return view('bpo.kelola_aset', compact('kategori', 'asets'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'kode_aset' => 'required|unique:asets',
            'kategori_id' => 'required',
            'stok' => 'required|integer|min:1'
        ]);

        Aset::create($request->all());
        return redirect()->back()->with('success', 'Aset berhasil ditambahkan.');
    }

    public function destroy($id) {
        Aset::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Aset berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kode_aset' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer|min:1'
        ]);

        $aset = Aset::findOrFail($id);
        $aset->update($request->only('nama', 'kode_aset', 'kategori_id', 'stok'));

        return redirect()->back()->with('success', 'Aset berhasil diupdate.');
    }

}