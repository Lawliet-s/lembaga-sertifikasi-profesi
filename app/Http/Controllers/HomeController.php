<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\Unikom;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }


    
    public function index3()
    {
        $xnxx = \App\Models\Xnxx::all();
        $info = \App\Models\Info::all();
        $info2 = \App\Models\Info2::all();
        $skema = \App\Models\Skema::where('status_id', '1')->get();
        $jurusan = \App\Models\Jurusan::all();
        $datasertifikat = \App\Models\Data_register::where('nik', auth()->user()->nik)
            ->where('status', "<h4 style='color: rgb(0, 0, 0)'>Sertifikasi Selesai</h4>")->count();
        $upload = \App\Models\Upload_file::where('user_id', auth()->user()->id)->get();
        $datareg = \App\Models\Data_register::where('user_id', auth()->user()->id)
            ->where('status', "<h4 style='color: rgb(163, 129, 8)'>Lengkapi Data Anda</h4>")
            ->get();
        $datareg1 = \App\Models\Data_register::where('user_id', auth()->user()->id)
            ->where('status', "<h4 style='color: green'>Menunggu Validasi...</h4>")
            ->get();
        $datareg2 = \App\Models\Data_register::where('user_id', auth()->user()->id)
            ->where('status', "<h4 style='color: rgb(34, 123, 138)'>Pendaftaran Divalidasi</h4>")
            ->get();
        $datareg3 = \App\Models\Data_register::where('user_id', auth()->user()->id)
            ->where('status', "<h4 style='color: rgb(141, 7, 7)'>Pendaftaran Ditolak</h4>")
            ->get();
        $datareg4 = \App\Models\Data_register::where('nik', auth()->user()->nik)
            ->where('status', "<h4 style='color: rgb(0, 0, 0)'>Sertifikasi Selesai</h4>")->get();
        $datareg5 = \App\Models\Data_register::where('nik', auth()->user()->nik)
            ->where('status', "<h4 style='color: #000'>Pendaftaran Sementara Diblokir</h4>")->get();
        return view('asesion', compact(
            'datareg', 'datareg1', 'datareg2', 'datareg3', 'datareg4', 'datareg5',
            'datasertifikat', 'xnxx', 'skema', 'info', 'info2', 'jurusan', 'upload',
        ));
    }

    public function list_skema()
    {
        $skema = Skema::all();
        $data = Skema::all();
        return view('skema2', compact('data', 'skema'));
    }

    public function skema1()
    {
        $unikom = Unikom::all();
        $data = Skema::all();
        $skema = Skema::all();
        return view('front/skema', compact('skema', 'data', 'unikom'));
    }

    public function list(Skema $skema)
    {
        $unikom = Unikom::all();
        $data = Skema::all();
        $skema = Skema::all();
        return view('front/list', compact('skema', 'data', 'unikom'));
    }
}
