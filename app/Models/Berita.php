<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas'; // default plural
    protected $fillable = ['judul', 'isi', 'gambar']; // sesuaikan kolom
}
