@extends('layout/admin')

@section('judul')
    Struktur Organisasi | Admin LSP
@endsection

@section('sidebar')
    sidebar-icon-only
@endsection

@section('isi')
    @include('layout/verifikasi')
    <div class="page-header">
        <h3>
            <i class="fas fa-sitemap"></i> Edit Gambar Struktur Organisasi
        </h3>
        <!-- /////////////////////////////////// -->
        <!-- BREADCRUMB -->
        <!-- /////////////////////////////////// -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom  bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
            </ol>
        </nav>
    </div><br>
    @forelse ($strorg as $asu)
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-image"></i> Ubah Gambar</h4>
                <form action="{{ route('strorg.update', $asu->id) }}" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="image">
                    </div>
                    <button type="submit" class="btn btn-rounded btn-info btn-icon-text">
                        <i class="fa fa-magic btn-icon-prepend"></i>
                        UPDATE
                    </button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <img src="{{ asset($asu->image) }}" style="width: 900px" alt="">
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-plus"></i> Tambah Gambar</h4>
                <form action="{{ route('strorg.store') }}" class="forms-sample" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-rounded btn-success btn-icon-text">
                        <i class="fa fa-save btn-icon-prepend"></i>
                        SIMPAN
                    </button>
                </form>
            </div>
        </div>
    @endforelse
@endsection
