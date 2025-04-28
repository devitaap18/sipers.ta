<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MsUser;
use App\Models\MsRole;

class UserController extends Controller
{
    public function index()
    {
        $users = MsUser::with('role')->get();
        $roles = MsRole::all();
        return view('superadmin.user.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:ms_user,username',
            'nik' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'role_id' => 'required|exists:ms_role,id',
        ]);

        MsUser::create($request->all());

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = MsUser::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:ms_user,username,' . $user->id,
            'nik' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'role_id' => 'required|exists:ms_role,id',
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = MsUser::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
