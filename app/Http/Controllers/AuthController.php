<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MsUser;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'nik' => 'required',
        ]);
    
        // Ambil user beserta relasi role-nya
        $user = MsUser::with('role')->where('username', $request->username)->first();
    
        // Periksa apakah user ditemukan dan NIK cocok
        if ($user && $user->nik === $request->nik) {
            Auth::login($user);
    
            // Redirect berdasarkan role_name dari relasi role
            $roleName = $user->role->role_name;
    
            return match ($roleName) {
                'admin' => redirect('/admin/dashboard'),
                'vp' => redirect('/vp/dashboard'),
                'bpo' => redirect('/bpo/dashboard'),
                'superadmin' => redirect('/superadmin/dashboard'),
                default => redirect('/login')->with('loginError', 'Role tidak dikenali'),
            };
        }
    
        return back()->with('loginError', 'Username atau NIK salah');
    }    

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
