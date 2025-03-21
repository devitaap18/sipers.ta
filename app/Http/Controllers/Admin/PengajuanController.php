<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\PengajuanAset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $pengajuan = Pengajuan::with('user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengajuan.index', compact('pengajuan'));
        
    }

    public function create()
    {
        $kategoriAset = KategoriAset::with('aset')->get();
        return view('admin.pengajuan.create', compact('kategoriAset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'departemen' => 'required',
            'tanggal_pemohon' => 'required|date',
            'perihal' => 'required',
            'deskripsi' => 'required',
            'aset_id' => 'required|array',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $pengajuan = Pengajuan::create([
                'user_id' => auth()->id(),
                'departemen' => $request->departemen,
                'tanggal_pemohon' => $request->tanggal_pemohon,
                'perihal' => $request->perihal,
                'deskripsi' => $request->deskripsi,
                'status_vp' => 'pending',
                'deskripsi_status_vp' => null,
                'status_bpo' => 'belum diproses',
            ]);

            foreach ($request->aset_id as $aset_id) {
                PengajuanAset::create([
                    'pengajuan_id' => $pengajuan->id,
                    'aset_id' => $aset_id,
                    'jumlah' => $request->jumlah[$aset_id],
                ]);
            }
        });

        return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['user', 'pengajuanAset.aset.kategori'])->findOrFail($id);

        $aset = $pengajuan->pengajuanAset->map(function($pa) {
            return [
                'nama' => $pa->aset->nama,
                'kategori' => $pa->aset->kategori->nama ?? 'Tidak Ada Kategori',
                'jumlah' => $pa->jumlah
            ];
        });

        return response()->json([
            'pengajuan' => $pengajuan,
            'aset' => $aset
        ]);
    }

}
