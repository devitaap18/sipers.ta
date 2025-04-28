<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MsRole;

class RoleController extends Controller
{
    public function index()
    {
        $roles = MsRole::all();
        return view('superadmin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        MsRole::create([
            'role_name' => $request->role_name,
        ]);

        return redirect()->back()->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        $role = MsRole::findOrFail($id);
        $role->update([
            'role_name' => $request->role_name,
        ]);

        return redirect()->back()->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = MsRole::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'Role berhasil dihapus.');
    }
}
