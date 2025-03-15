<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'nik' => 'required',
        ]);
    
        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();
    
        // Periksa apakah user ditemukan dan NIK cocok (karena tidak di-hash)
        if ($user && $user->nik === $request->nik) {
            Auth::login($user);
    
            // Redirect berdasarkan role
            return match ($user->role) {
                'admin' => redirect('/admin/dashboard'),
                'vp'    => redirect('/vp/dashboard'),
                'bpo'   => redirect('/bpo/dashboard'),
                default => redirect('/dashboard'),
            };
        }
    
        return back()->with('loginError', 'Username atau NIK salah');
    }    

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
