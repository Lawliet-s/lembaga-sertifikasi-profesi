<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'permohonan_id',
        'nama_perusahaan',
        'jabatan',
        'alamat_kantor',
        'kode_pos_kantor',
        'telepon_kantor',
        'email_kantor',
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }
}
