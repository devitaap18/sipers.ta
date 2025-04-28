<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\MsUser;
use App\Models\MsRole;
use App\Models\MsMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data statistik
        $totalUsers = MsUser::count();
        $totalRoles = MsRole::count();
        $totalMenus = MsMenu::count();

        // Mengirim data ke view
        return view('superadmin.dashboard', compact('totalUsers', 'totalRoles', 'totalMenus'));
    }
}
