<?php

namespace App\Http\Controllers\BPO;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Aset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    // Menampilkan pengajuan yang telah disetujui oleh VP
    public function index()
    {
        $pengajuan = Pengajuan::where('status_vp', 'disetujui')->get();
        return view('bpo.pengajuan.index', compact('pengajuan'));
    }

    // Memperbarui status_bpo dan mengurangi stok aset
    public function updateStatus(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_bpo = $request->status_bpo;
        $pengajuan->save();

        // Jika status_bpo menjadi "selesai", kurangi stok aset
        if ($request->status_bpo == 'selesai') {
            $this->kurangiStok($pengajuan);
        }

        return redirect()->route('bpo.pengajuan.index')->with('success', 'Status BPO diperbarui!');
    }

    // Fungsi untuk mengurangi stok aset berdasarkan pengajuan yang disetujui
    private function kurangiStok(Pengajuan $pengajuan)
    {
        DB::transaction(function () use ($pengajuan) {
            // Pastikan relasi pengajuanAset dimuat
            $pengajuan->load('pengajuanAset');

            foreach ($pengajuan->pengajuanAset as $pengajuanAset) { // Perbaikan di sini
                // Ambil aset berdasarkan aset_id yang ada di pengajuanAset
                $aset = Aset::find($pengajuanAset->aset_id);

                if (!$aset) {
                    throw new \Exception("Aset dengan ID '{$pengajuanAset->aset_id}' tidak ditemukan!");
                }

                if ($aset->stok >= $pengajuanAset->jumlah) {
                    // Kurangi stok aset
                    $aset->decrement('stok', $pengajuanAset->jumlah);
                } else {
                    throw new \Exception("Stok aset '{$aset->nama}' tidak mencukupi!");
                }
            }
        });
    }

}
