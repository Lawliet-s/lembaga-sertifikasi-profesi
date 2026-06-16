@extends('layout/admin')

@section('judul')
    Gambar Halaman Auth | Admin LSP
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    @include('layout/verifikasi')

    <div class="page-header">
        <h4>
            <i class="fas fa-images"></i> Pengaturan Gambar Halaman Login & Register
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-danger">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}" style="color: var(--secondary-color)">Dashboard</a></li>
                <li class="breadcrumb-item active" style="color: #fff" aria-current="page">Gambar Auth</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('auth.images.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="row">
                    {{-- Login Admin --}}
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Login Admin & Asesor</h5>
                                <img src="{{ asset($images['login_admin']) }}" class="img-fluid mb-3 rounded" style="max-height:150px">
                                <div class="form-group">
                                    <input type="file" name="login_admin" accept="image/png,image/jpeg" class="form-control-file">
                                    <small class="text-muted">Format: PNG/JPG, Max 2MB</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Login Asesi --}}
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Login Asesi</h5>
                                <img src="{{ asset($images['login_asesi']) }}" class="img-fluid mb-3 rounded" style="max-height:150px">
                                <div class="form-group">
                                    <input type="file" name="login_asesi" accept="image/png,image/jpeg" class="form-control-file">
                                    <small class="text-muted">Format: PNG/JPG, Max 2MB</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Register --}}
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Register</h5>
                                <img src="{{ asset($images['register']) }}" class="img-fluid mb-3 rounded" style="max-height:150px">
                                <div class="form-group">
                                    <input type="file" name="register" accept="image/png,image/jpeg" class="form-control-file">
                                    <small class="text-muted">Format: PNG/JPG, Max 2MB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">
                    <i class="fas fa-save"></i> Simpan Semua Gambar
                </button>
            </form>
        </div>
    </div>
@endsection
