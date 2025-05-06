<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        // Hitung jumlah pengajuan berdasarkan status di tahun tertentu
        $pendingCount = Pengajuan::where('status_vp', 'pending')
            ->whereYear('created_at', $tahun)
            ->count();

        $approvedCount = Pengajuan::where('status_vp', 'disetujui')
            ->whereYear('created_at', $tahun)
            ->count();

        $rejectedCount = Pengajuan::where('status_vp', 'ditolak')
            ->whereYear('created_at', $tahun)
            ->count();

        // Hitung jumlah pengajuan berdasarkan status per bulan, difilter berdasarkan tahun
        $monthlyDataPending = Pengajuan::where('status_vp', 'pending')
            ->whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyDataApproved = Pengajuan::where('status_vp', 'disetujui')
            ->whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyDataRejected = Pengajuan::where('status_vp', 'ditolak')
            ->whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Tambahkan 0 untuk bulan yang tidak ada data
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

        // Urutkan berdasarkan bulan
        ksort($monthlyDataPending);
        ksort($monthlyDataApproved);
        ksort($monthlyDataRejected);

        return view('admin.dashboard', compact(
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'monthlyDataPending',
            'monthlyDataApproved',
            'monthlyDataRejected',
            'tahun'
        ));
    }
}
