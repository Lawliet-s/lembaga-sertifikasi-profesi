<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrAk03 extends Model
{
    use HasFactory;

    protected $table = 'fr_ak_03';

    protected $fillable = [
        'data_register_id',
        'user_id',
        'rating',
        'feedback',
        'catatan',
        'saran',
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
