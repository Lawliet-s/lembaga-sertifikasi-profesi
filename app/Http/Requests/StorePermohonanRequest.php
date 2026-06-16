<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermohonanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Data Pribadi
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|numeric|digits_between:16,20',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kebangsaan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'pendidikan' => 'required|string|max:255',

            // Data Pekerjaan
            'nama_perusahaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat_kantor' => 'required|string',
            'kode_pos_kantor' => 'required|string|max:10',
            'telepon_kantor' => 'required|string|max:20',
            'email_kantor' => 'required|email|max:255',

            // Skema
            'skema_id' => 'required|exists:skemas,id',
            'tujuan_asesmen' => 'required|in:sertifikasi,pkt,rpl,lainnya',

            // Tanda Tangan
            'ttd' => 'nullable|string',

            // Dokumen
            'dokumen_raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_sertifikat_pkl' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_foto' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.digits_between' => 'NIK harus antara 16-20 digit',
            'skema_id.required' => 'Silakan pilih skema sertifikasi',
            'dokumen_*.max' => 'Ukuran file maksimal 2MB',
            'dokumen_*.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
        ];
    }
}
