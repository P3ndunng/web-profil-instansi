<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal',
    ];

    protected $dates = [
        'tanggal',
        'created_at',
        'updated_at'
    ];

    // Accessor untuk format tanggal Indonesia
    public function getTanggalFormattedAttribute()
    {
        if ($this->tanggal) {
            return Carbon::parse($this->tanggal)->translatedFormat('l, d F Y');
        }
        return $this->created_at->translatedFormat('l, d F Y');
    }

    // Accessor untuk excerpt
    public function getExcerptAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->isi), 120);
    }

    // Scope untuk artikel terbaru
    public function scopeTerbaru($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
}
