<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->bootstrap();

use App\Models\Permohonan;
use App\Models\Data_register;
use App\Models\Sex;

// Delete ALL Data_register records that don't have a matching Permohonan
Data_register::whereNotNull('id')->chunk(100, function($records) {
    foreach ($records as $r) {
        $exists = Permohonan::where('user_id', (int) $r->user_id)
            ->where('skema_id', (int) $r->skema_id)
            ->exists();
        if (!$exists) {
            $r->upload_files()->delete();
            $r->xnxxes()->delete();
            $r->penilaians()->delete();
            $r->observasis()->delete();
            $r->delete();
            echo "Deleted test Data_register ID: {$r->id}\n";
        }
    }
});

// Now create Data_register for ALL Permohonan that don't have one
$permohonans = Permohonan::with(['user','dataPribadi','pekerjaan','dokumens','skema'])->get();

foreach ($permohonans as $p) {
    if (!$p->dataPribadi) {
        echo "Skip Permohonan ID {$p->id} - no dataPribadi\n";
        continue;
    }

    // Check if already exists
    $existing = Data_register::where('user_id', (string) $p->user_id)
        ->where('id_skema', (string) $p->skema_id)
        ->first();
    if ($existing) {
        echo "Already exists Data_register ID: {$existing->id} for Permohonan ID: {$p->id}\n";
        continue;
    }

    $sex = Sex::where('sex', ($p->dataPribadi->jenis_kelamin ?? 'L') === 'L' ? 'Laki-laki' : 'Perempuan')->first();
    $lastId = Data_register::max('id') ?? 0;

    $dr = Data_register::create([
        'id' => $lastId + 1,
        'user_id' => (string) $p->user_id,
        'user_name' => $p->user->name ?? '',
        'skema_id' => (string) $p->skema_id,
        'skema_name' => $p->skema->skema ?? '',
        'kode_skema' => $p->skema->kode_skema ?? '',
        'id_skema' => (string) $p->skema_id,
        'kode' => $p->tujuan_asesmen,
        'status' => "<h4 style='color: green'>Menunggu Validasi...</h4>",
        'nik' => $p->dataPribadi->nik ?? '',
        'tmpt_lahir' => $p->dataPribadi->tempat_lahir ?? '',
        'tgl_lahir' => $p->dataPribadi->tanggal_lahir ?? '',
        'sex_id' => (string) ($sex->id ?? ''),
        'negara' => $p->dataPribadi->kebangsaan ?? '',
        'alamat' => $p->dataPribadi->alamat ?? '',
        'kode_post' => $p->dataPribadi->kode_pos ?? '',
        'no_hp' => $p->dataPribadi->no_hp ?? '',
        'surel' => $p->dataPribadi->email ?? '',
        'institusi' => $p->pekerjaan->nama_perusahaan ?? '',
        'jabatan' => $p->pekerjaan->jabatan ?? '',
        'alamat_kantor' => $p->pekerjaan->alamat_kantor ?? '',
        'postal' => $p->pekerjaan->kode_pos_kantor ?? '',
        'telp' => $p->pekerjaan->telepon_kantor ?? '',
        'email3' => $p->pekerjaan->email_kantor ?? '',
        'tmt' => $p->dataPribadi->pendidikan ?? '',
        'jenis' => 'Baru',
        'image' => optional($p->dokumens->where('jenis_dokumen', 'foto_3x4')->first())->path_file,
    ]);

    $dokumenMap = [
        'ktp' => 'KTP',
        'kartu_keluarga' => 'Kartu Keluarga',
        'raport' => 'Raport',
        'sertifikat_pkl' => 'Sertifikat PKL',
        'foto_3x4' => 'Pas Foto',
    ];
    foreach ($p->dokumens as $dok) {
        $docLabel = $dokumenMap[$dok->jenis_dokumen] ?? $dok->jenis_dokumen;
        $dr->upload_files()->create([
            'name' => $dok->nama_file,
            'kode' => $p->skema_id,
            'kode_dokumen' => $docLabel,
            'image' => $dok->path_file,
            'user_id' => (string) $p->user_id,
            'status' => 'pending',
        ]);
    }

    echo "Created Data_register ID: {$dr->id} for Permohonan ID: {$p->id} ({$p->dataPribadi->nama_lengkap})\n";
}

echo "\nFinal Data_register count: " . Data_register::count() . "\n";
foreach (Data_register::all() as $r) {
    echo "  ID:{$r->id} Name:{$r->user_name} Skema:{$r->skema_name}\n";
}
