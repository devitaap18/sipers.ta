<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah pengguna berdasarkan role
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalVps = User::where('role', 'vp')->count();
        $totalBpos = User::where('role', 'bpo')->count();

        return view('superadmin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalVps' => $totalVps,
            'totalBpos' => $totalBpos,
        ]);
    }
}
