<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with(['parent', 'children'])
            ->orderBy('parent_id', 'asc')
            ->orderBy('urutan', 'asc')
            ->get();

        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('urutan')
            ->get();

        return view('menu.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'urutan' => 'required|integer|min:0',
            'parent_id' => 'nullable|exists:menus,id',
            'is_active' => 'boolean',
            'icon' => 'nullable|string|max:100',
            'target' => 'required|in:_self,_blank'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Menu::create($data);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->where('is_active', true)
            ->where('id', '!=', $menu->id) // Tidak bisa pilih dirinya sendiri
            ->orderBy('urutan')
            ->get();

        return view('menu.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'urutan' => 'required|integer|min:0',
            'parent_id' => 'nullable|exists:menus,id',
            'is_active' => 'boolean',
            'icon' => 'nullable|string|max:100',
            'target' => 'required|in:_self,_blank'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Pastikan tidak ada circular dependency
        if ($request->parent_id && $this->wouldCreateCircular($menu->id, $request->parent_id)) {
            return back()->withErrors(['parent_id' => 'Tidak dapat membuat menu induk karena akan membuat circular dependency']);
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }

    public function toggleStatus(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);

        return back()->with('success', 'Status menu berhasil diubah');
    }

    // Helper method untuk mencegah circular dependency
    private function wouldCreateCircular($menuId, $parentId)
    {
        $parent = Menu::find($parentId);

        while ($parent) {
            if ($parent->id == $menuId) {
                return true;
            }
            $parent = $parent->parent;
        }

        return false;
    }

    // API untuk mendapatkan menu untuk frontend
    public function getMenusForNavbar()
    {
        $menus = Menu::mainMenus()
            ->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('urutan');
            }])
            ->get();

        return response()->json($menus);
    }
}
