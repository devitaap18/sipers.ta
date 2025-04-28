<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MsMenu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = MsMenu::orderBy('order')->get();
        $parentMenus = MsMenu::whereNull('parent_id')->orderBy('order')->get();
        return view('superadmin.menu.index', compact('menus', 'parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:ms_menu,id',
        ]);

        MsMenu::create($request->only(['menu_name', 'url', 'order', 'icon', 'parent_id']));

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:ms_menu,id',
        ]);

        $menu = MsMenu::findOrFail($id);
        $menu->update($request->only(['menu_name', 'url', 'order', 'icon', 'parent_id']));

        return redirect()->back()->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = MsMenu::findOrFail($id);
        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }
}
