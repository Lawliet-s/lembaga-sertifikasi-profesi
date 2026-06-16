<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_register_id',
        'unikom_id',
        'nilai',
    ];

    public function dataRegister()
    {
        return $this->belongsTo(Data_register::class, 'data_register_id');
    }

    public function unikom()
    {
        return $this->belongsTo(Unikom::class);
    }
}
