<?php

namespace App\Http\Controllers\VP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah pengajuan berdasarkan status untuk user yang login
        $pendingCount = Pengajuan::where('status_vp', 'pending')->count();
        $approvedCount = Pengajuan::where('status_vp', 'disetujui')->count();
        $rejectedCount = Pengajuan::where('status_vp', 'ditolak')->count();

        return view('vp.dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount'));
    }
}
