@extends('layout.asesor')

@section('judul')
Profil Asesor | {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    <div class="page-header">
        <h4>
            <i class="fas fa-user"></i> Profil Asesor
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('dashboard.asesor') }}">Asesor</a>
                </li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>
    </div><br>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="font font-weight-bold">Data Pribadi</h5><br>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 200px;">Nama</th>
                        <td>{{ $asesor->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $asesor->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection