<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrAk04 extends Model
{
    use HasFactory;

    protected $table = 'fr_ak_04';

    protected $fillable = [
        'data_register_id',
        'user_id',
        'alasan',
        'file_path',
        'status',
        'catatan_admin',
        'diajukan_at',
        'ditinjau_at',
        'diputus_at',
    ];

    protected $casts = [
        'diajukan_at' => 'datetime',
        'ditinjau_at' => 'datetime',
        'diputus_at' => 'datetime',
    ];

    public function dataRegister()
    {
        return $this->belongsTo(Data_register::class, 'data_register_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
