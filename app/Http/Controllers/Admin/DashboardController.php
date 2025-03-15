<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Hitung jumlah pengajuan berdasarkan status untuk user yang login
        $pendingCount = Pengajuan::where('user_id', $userId)->where('status_vp', 'pending')->count();
        $approvedCount = Pengajuan::where('user_id', $userId)->where('status_vp', 'disetujui')->count();
        $rejectedCount = Pengajuan::where('user_id', $userId)->where('status_vp', 'ditolak')->count();

        return view('admin.dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount'));
    }
}
