<?php

namespace App\Http\Controllers\BPO;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::where('status_vp', 'Disetujui')->orderBy('updated_at', 'desc')->get();
        return view('bpo.dashboard', compact('pengajuans'));
    }
}
