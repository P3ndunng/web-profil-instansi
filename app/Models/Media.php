<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['judul', 'file', 'tipe'];
    protected $table='media';
}
