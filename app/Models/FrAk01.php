<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrAk01 extends Model
{
    use HasFactory;

    protected $table = 'fr_ak_01';

    protected $fillable = [
        'data_register_id',
        'user_id',
        'ttd',
        'ttd_path',
        'agreed_at',
        'status',
    ];

    protected $casts = [
        'agreed_at' => 'datetime',
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
