<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'link',
        'urutan',
        'parent_id',
        'is_active',
        'icon',
        'target'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi parent (menu induk)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Relasi children (sub menu)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('urutan');
    }

    // Mendapatkan menu utama (parent = null)
    public function scopeMainMenus($query)
    {
        return $query->whereNull('parent_id')->where('is_active', true)->orderBy('urutan');
    }

    // Mendapatkan sub menu dari menu tertentu
    public function scopeSubMenus($query, $parentId)
    {
        return $query->where('parent_id', $parentId)->where('is_active', true)->orderBy('urutan');
    }

    // Check apakah menu memiliki sub menu
    public function hasChildren()
    {
        return $this->children()->where('is_active', true)->exists();
    }

    // Mendapatkan path lengkap menu (breadcrumb)
    public function getFullPath()
    {
        $path = [];
        $menu = $this;

        while ($menu) {
            array_unshift($path, $menu->nama);
            $menu = $menu->parent;
        }

        return implode(' > ', $path);
    }
}
