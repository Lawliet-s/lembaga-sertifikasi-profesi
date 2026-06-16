@extends('layout/admin')

@section('judul')
{{ $user->name }} | Admin LSP
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    @include('layout/verifikasi')
    <div class="page-header">
        <h4>
            <i class="fas fa-user"></i> Edit Akun Asesi
        </h4>
        <!-- /////////////////////////////////// -->
        <!-- BREADCRUMB -->
        <!-- /////////////////////////////////// -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom  bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item"><a href="{{ (Auth::user() && Auth::user()->hasRole('asesor')) ? route('dashboard.asesor') : route('admin') }}">Dashboard</a></li>
                <li style="color: var(--secondary-color)" class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">{{ $user->id }}</li>
            </ol>
        </nav>
    </div><br>
    <!-- /////////////////////////////////// -->
    <!-- EDIT DATA -->
    <!-- /////////////////////////////////// -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><i class="fas fa-user"></i> {{ $user->name }}</h4>
            <form action="{{ route('user_update2', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="form-sample">
                @csrf
                @method('put')
                <!-- <input type="hidden" name="role" value="user"> -->
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="100" class="form-control" name="name"
                                    value="{{ $user->name }}">
                                @error('name')
                                    <div class="text-danger mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="50" class="form-control" name="nik"
                                    value="{{ $user->nik }}">
                                @error('nik')
                                    <div class="text-danger mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" maxlength="255" class="form-control" name="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <div class="text-danger mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ganti Password</label>
                            <div class="col-sm-9">
                                <input type="password"  maxlength="100" class="form-control" name="password">
                                @error('password')
                                    <div class="text-danger mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <a href=""><button class="btn btn-rounded btn-info btn-block"><i class="fas fa-save"></i> Update data
                    Pengguna</button></a>
            </form>
        </div>
    </div>
@endsection
