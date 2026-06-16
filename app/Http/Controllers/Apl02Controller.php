<?php

namespace App\Http\Controllers;

use App\Models\Asesmen;
use App\Models\Data_register;
use App\Models\Skema;
use App\Models\Unikom;
use App\Models\Xnxx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Apl02Controller extends Controller
{
    public function index()
    {
        $registrations = Data_register::where('user_id', auth()->user()->id)
            ->where(function ($q) {
                $q->where('status', "<h4 style='color: rgb(34, 123, 138)'>Pendaftaran Divalidasi</h4>")
                  ->orWhere('status', "<h4 style='color: rgb(0, 0, 0)'>Sertifikasi Selesai</h4>");
            })
            ->get();

        return view('asesi.apl02.index', compact('registrations'));
    }

    public function create($id)
    {
        $registration = Data_register::findOrFail($id);
        $skema = Skema::findOrFail($registration->skema_id);

        $unikoms = Unikom::where('skema_id', $skema->id)
            ->with('asesmens')
            ->get();

        $existing = Xnxx::where('data_register_id', $registration->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('asesi.apl02.create', compact('registration', 'skema', 'unikoms', 'existing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_register_id' => 'required|exists:data_registers,id',
            'elemen_id' => 'required|array',
            'elemen_id.*' => 'exists:elemen,id',
            'status' => 'required|array',
            'status.*' => 'in:kompeten,tidak_kompeten',
            'image' => 'nullable|array',
            'image.*' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
        ]);

        $dataRegisterId = $request->data_register_id;
        $registration = Data_register::findOrFail($dataRegisterId);

        foreach ($request->elemen_id as $i => $elemenId) {
            $elemen = Asesmen::with('unikom')->findOrFail($elemenId);
            $kode = $i + 1 . auth()->user()->id;
            $kodeElemen = $i + 1 . auth()->user()->id . $dataRegisterId;

            $imagePath = null;
            if ($request->hasFile('image.' . $i)) {
                $file = $request->file('image.' . $i);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move('uploads/formulir_apl2/', $filename);
                $imagePath = 'uploads/formulir_apl2/' . $filename;
            }

            $statusLabel = $request->status[$i] === 'kompeten'
                ? "<label class='badge badge-outline-success badge-pill'>&#10004; Kompeten</label>"
                : "<label class='badge badge-outline-danger badge-pill'>&#10008; Tidak Kompeten</label>";

            Xnxx::updateOrCreate(
                [
                    'data_register_id' => $dataRegisterId,
                    'kode_elemen' => $kodeElemen,
                ],
                [
                    'user_id' => auth()->user()->id,
                    'unikom_id' => $elemen->unikom_id,
                    'unikom_name' => $elemen->unikom->unikom ?? '',
                    'unikom_kode' => $elemen->unikom->kode_unikom ?? '',
                    'asesmen_name' => $elemen->asesmen,
                    'kriteria' => $elemen->kriteria,
                    'skema_id' => $registration->skema_id,
                    'skema_name' => $registration->skema_name,
                    'kode' => $kode,
                    'status' => $statusLabel,
                    'image' => $imagePath,
                    'koreksi' => "<label class='badge badge-outline-warning badge-pill'>Belum Dikoreksi</label>",
                ]
            );
        }

        return redirect()->route('apl02.show', $dataRegisterId)
            ->with('success', 'FR.APL.02 — Asesmen Mandiri berhasil disimpan.');
    }

    public function show($id)
    {
        $registration = Data_register::findOrFail($id);
        $xnxxes = Xnxx::where('data_register_id', $registration->id)
            ->where('user_id', auth()->user()->id)
            ->get()
            ->groupBy('unikom_name');

        return view('asesi.apl02.show', compact('registration', 'xnxxes'));
    }
}
