<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuk extends Model
{
    use HasFactory;
    protected $fillable = ['tuk', 'kode', 'alamat', 'pengelola', 'jenis_tuk', 'image'];
    protected $table = 'tuk';
}
