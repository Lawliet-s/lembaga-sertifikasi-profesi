<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_register_id',
        'aktivitas',
        'catatan',
        'file',
    ];

    protected $casts = [
        'aktivitas' => 'array',
    ];

    public function dataRegister()
    {
        return $this->belongsTo(Data_register::class, 'data_register_id');
    }
}
