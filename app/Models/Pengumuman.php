<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen'; // sesuaikan dengan nama tabel Anda
    protected $fillable = ['judul', 'isi', 'tanggal'];

    protected $dates = ['tanggal'];

    // Format otomatis tanggal
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal ? Carbon::parse($this->tanggal)->format('d-m-Y') : null;
    }
}
