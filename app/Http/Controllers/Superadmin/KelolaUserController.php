<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KelolaUserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('superadmin.kelola_user.index', compact('users'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('superadmin.kelola_user.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'nik' => 'required|string|max:20|unique:users',
            'role' => 'required|in:admin,vp,bpo',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.kelola-user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.kelola_user.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'nik' => 'required|string|max:20|unique:users,nik,' . $id,
            'role' => 'required|in:admin,vp,bpo',
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'nik' => $request->nik,
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.kelola-user.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.kelola-user.index')->with('success', 'User berhasil dihapus.');
    }
}
