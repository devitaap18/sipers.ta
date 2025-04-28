<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Hitung jumlah pengajuan berdasarkan status untuk user yang login
        $pendingCount = Pengajuan::where('user_id', $userId)->where('status_vp', 'pending')->count();
        $approvedCount = Pengajuan::where('user_id', $userId)->where('status_vp', 'disetujui')->count();
        $rejectedCount = Pengajuan::where('user_id', $userId)->where('status_vp', 'ditolak')->count();

        // Hitung jumlah pengajuan berdasarkan status per bulan
        $monthlyDataPending = Pengajuan::where('user_id', $userId)
            ->where('status_vp', 'pending')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyDataApproved = Pengajuan::where('user_id', $userId)
            ->where('status_vp', 'disetujui')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyDataRejected = Pengajuan::where('user_id', $userId)
            ->where('status_vp', 'ditolak')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Menambahkan data yang tidak ada untuk bulan tertentu dengan nilai 0
        for ($i = 1; $i <= 12; $i++) {
        if (!array_key_exists($i, $monthlyDataPending)) {
        $monthlyDataPending[$i] = 0;
        }
        if (!array_key_exists($i, $monthlyDataApproved)) {
        $monthlyDataApproved[$i] = 0;
        }
        if (!array_key_exists($i, $monthlyDataRejected)) {
        $monthlyDataRejected[$i] = 0;
        }
        }

        // Kirimkan data jumlah pengajuan per bulan ke view
        return view('admin.dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount', 'monthlyDataPending', 'monthlyDataApproved', 'monthlyDataRejected'));
    }
}
