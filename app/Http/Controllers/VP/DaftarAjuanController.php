<?php

namespace App\Http\Controllers\VP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Validator;

class DaftarAjuanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter status_vp jika ada
        $status = $request->query('status_vp');
        
        // Ambil semua data pengajuan dengan relasi user, filter jika status_vp ada
        $pengajuan = Pengajuan::with('user')
                    ->when($status, function ($query) use ($status) {
                        return $query->where('status_vp', $status);
                    })
                    ->orderBy('tanggal_pemohon', 'desc')
                    ->paginate(10); // Tambahkan pagination

        // Kirim data ke view
        return view('vp.daftar_ajuan', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi status hanya bisa: pending, disetujui, atau ditolak
        $validator = Validator::make($request->all(), [
            'status_vp' => 'required|in:pending,disetujui,ditolak',
            'deskripsi_status_vp' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid',
                'errors' => $validator->errors()
            ], 400);
        }

        // Cari pengajuan berdasarkan ID
        $pengajuan = Pengajuan::find($id);

        if (!$pengajuan) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan tidak ditemukan'
            ], 404);
        }

        // Update status pengajuan
        $pengajuan->status_vp = $request->status_vp;
        $pengajuan->deskripsi_status_vp = $request->deskripsi_status_vp;
        $pengajuan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pengajuan berhasil diperbarui',
            'data' => $pengajuan
        ]);
    }
}
