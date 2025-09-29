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
        // Ambil semua menu yang bisa jadi parent (main menu dan sub menu level 1)
        $parentMenus = Menu::where('is_active', true)
            ->whereNull('parent_id')
            ->orWhereHas('parent', function($query) {
                $query->whereNull('parent_id');
            })
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
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Validasi level menu (max 3 level)
        if ($request->parent_id) {
            $parent = Menu::find($request->parent_id);
            if ($parent && $parent->parent_id) {
                // Parent sudah level 2, tidak bisa tambah child lagi
                return back()->withErrors(['parent_id' => 'Maksimal 3 level menu (Main Menu > Sub Menu > Sub-Sub Menu)'])
                    ->withInput();
            }
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        // Ambil parent menu yang valid (tidak termasuk dirinya sendiri dan child-nya)
        $parentMenus = Menu::where('is_active', true)
            ->where('id', '!=', $menu->id)
            ->whereNull('parent_id')
            ->orWhereHas('parent', function($query) use ($menu) {
                $query->whereNull('parent_id')
                    ->where('id', '!=', $menu->id);
            })
            ->orderBy('urutan')
            ->get();

        // Filter out menu yang akan menyebabkan circular dependency
        $parentMenus = $parentMenus->filter(function($item) use ($menu) {
            return !$this->isDescendant($menu->id, $item->id);
        });

        return view('menu.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

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
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Validasi circular dependency
        if ($request->parent_id && $this->wouldCreateCircular($menu->id, $request->parent_id)) {
            return back()->withErrors(['parent_id' => 'Tidak dapat membuat menu induk karena akan membuat circular dependency'])
                ->withInput();
        }

        // Validasi level menu (max 3 level)
        if ($request->parent_id) {
            $parent = Menu::find($request->parent_id);
            if ($parent && $parent->parent_id) {
                return back()->withErrors(['parent_id' => 'Maksimal 3 level menu'])
                    ->withInput();
            }
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Cek apakah menu memiliki children
        if ($menu->children()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus menu yang memiliki sub menu. Hapus sub menu terlebih dahulu.');
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }

    /**
     * Toggle status aktif/nonaktif menu via AJAX
     */
    public function toggleStatus(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);

            // Cek apakah request dari AJAX
            if ($request->ajax() || $request->wantsJson()) {
                // Ambil status dari request atau toggle otomatis
                if ($request->has('is_active')) {
                    $menu->is_active = $request->boolean('is_active');
                } else {
                    $menu->is_active = !$menu->is_active;
                }

                $menu->save();

                // Jika menu dinonaktifkan, nonaktifkan juga semua child-nya
                if (!$menu->is_active) {
                    $this->deactivateChildren($menu);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Status menu berhasil diubah menjadi ' . ($menu->is_active ? 'Aktif' : 'Nonaktif'),
                    'is_active' => $menu->is_active
                ]);
            }

            // Fallback untuk request biasa (bukan AJAX)
            $menu->is_active = !$menu->is_active;
            $menu->save();

            // Jika menu dinonaktifkan, nonaktifkan juga semua child-nya
            if (!$menu->is_active) {
                $this->deactivateChildren($menu);
            }

            return back()->with('success', 'Status menu berhasil diubah');

        } catch (\Exception $e) {
            \Log::error('Error toggling menu status: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengubah status menu: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal mengubah status menu');
        }
    }

    /**
     * Helper method untuk mencegah circular dependency
     */
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

    /**
     * Cek apakah menu adalah descendant dari menu lain
     */
    private function isDescendant($menuId, $potentialAncestorId)
    {
        $menu = Menu::find($potentialAncestorId);

        while ($menu) {
            if ($menu->parent_id == $menuId) {
                return true;
            }
            $menu = $menu->parent;
        }

        return false;
    }

    /**
     * Nonaktifkan semua children dari menu
     */
    private function deactivateChildren($menu)
    {
        foreach ($menu->children as $child) {
            $child->update(['is_active' => false]);

            // Rekursif untuk nested children
            if ($child->children()->count() > 0) {
                $this->deactivateChildren($child);
            }
        }
    }

    /**
     * API untuk mendapatkan menu untuk frontend
     */
    public function getMenusForNavbar()
    {
        $menus = Menu::mainMenus()
            ->with(['children' => function($query) {
                $query->where('is_active', true)
                    ->orderBy('urutan')
                    ->with(['children' => function($subQuery) {
                        $subQuery->where('is_active', true)->orderBy('urutan');
                    }]);
            }])
            ->get();

        return response()->json($menus);
    }

    /**
     * Reorder menu positions via AJAX
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->items as $item) {
            Menu::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan menu berhasil diperbarui']);
    }

    /**
     * Duplikat menu
     */
    public function duplicate($id)
    {
        $menu = Menu::findOrFail($id);

        $newMenu = $menu->replicate();
        $newMenu->nama = $menu->nama . ' (Copy)';
        $newMenu->urutan = Menu::where('parent_id', $menu->parent_id)->max('urutan') + 1;
        $newMenu->is_active = false; // Default nonaktif untuk review
        $newMenu->save();

        return back()->with('success', 'Menu berhasil diduplikat. Silakan review dan aktifkan menu baru.');
    }
}
