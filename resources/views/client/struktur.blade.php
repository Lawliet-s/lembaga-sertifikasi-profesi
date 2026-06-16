@extends('layout.client')
@section('judul')
    Struktur | LSP
@endsection

@section('profil')
    active
@endsection

@section('isi')
    <!-- ***** Header ***** -->
    <div style="background-image: url('{{ asset($site_setting->header_image ?? 'general/assets/images/head1.jpg') }}')" class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-sitemap"></i> Struktur Organisasi</h1>
                    <span>{{ $site_setting->title ?? 'Lembaga Sertifikasi Profesi' }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Akhir Header ***** -->

    <!-- ***** Koten ***** -->
    <!-- Logo -->
    <div id="logo" class="more-info about-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="more-info-content">
                        <div class="col-md-8 align-self-center">
                        </div>
                        <div class="col-md-12">
                            @forelse ($struktur as $asu)
                                <img src="{{ asset($asu->image) }}" width="100%" alt="">
                            @empty
                                <p class="text-muted text-center">Belum ada struktur organisasi.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br>
    <!-- ***** Akhir Konten ***** -->
@endsection
