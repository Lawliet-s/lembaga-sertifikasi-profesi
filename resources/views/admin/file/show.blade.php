@extends('layout/admin')

@section('judul')
{{ $file->file }} | Admin LSP
@endsection

@section('sidebar')
    sidebar-icon-only
@endsection

@section('isi')
    {{-- <---------------------- PAGE HEADER ----------------------> --}}
    <div class="page-header">
        <h4>
            <i class="fas fa-upload"></i> Tampilan File
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom  bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item"><a href="{{ (Auth::user() && Auth::user()->hasRole('asesor')) ? route('dashboard.asesor') : route('admin') }}">Dashboard</a></li>
                <li style="color: var(--secondary-color)" class="breadcrumb-item"><a href="{{ route('file.index') }}">Upload File Dokumen</a></li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">{{ $file->id }}</li>
            </ol>
        </nav>
    </div><br>
    <div class="card col-md-12">
        <div class="card-body">
            <h4 class="card-title">Nama File : {{ $file->file }}</h4>
            <embed src="{{ asset($file->image) }}" class="col-md-12" height="500px" type="application/pdf">
            <div class="card-body">
            </div>
        </div>
    </div>
@endsection
