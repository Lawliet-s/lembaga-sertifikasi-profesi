@extends('layout.asesor')

@section('judul')
Penilaian Asesi | {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    <div class="page-header">
        <h4>
            <i class="fas fa-file-alt"></i> Penilaian Asesi
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('dashboard.asesor') }}">Asesor</a>
                </li>
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('asesor.penilaian') }}">Penilaian Asesi</a>
                </li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">
                    {{ $register->user_name ?? 'Detail' }}
                </li>
            </ol>
        </nav>
    </div>

    @include('layout.verifikasi')

    <form action="{{ route('asesor.penilaian.update', $register->id) }}" method="POST">
        @csrf

        <div class="row">
            {{-- INFORMASI ASESI --}}
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="fas fa-user mr-2"></i>Informasi Asesi</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama</strong></td>
                                <td>: {{ $register->user_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Skema Sertifikasi</strong></td>
                                <td>: {{ $register->skema_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jadwal Asesmen</strong></td>
                                <td>:
                                    @if ($register->date)
                                        {{ optional($register->date)->format('d/m/Y') }}
                                        @if ($register->time)
                                            {{ $register->time }}
                                        @endif
                                    @else
                                        <span class="text-muted">Belum dijadwalkan</span>
                                    @endif
                                </td>
                            </tr>
                            @if ($register->tuk)
                            <tr>
                                <td><strong>TUK</strong></td>
                                <td>: {{ $register->tuk?->tuk ?? $register->tuk?->alamat ?? '-' }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                {{-- RELASI --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-link mr-2"></i>Relasi dengan Modul Lain</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">
                            <i class="fas fa-info-circle mr-1"></i>
                            Hasil penilaian akan digunakan untuk observasi dan validasi akhir.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('asesor.observasi.show', $register->id) }}"
                                class="btn btn-warning btn-block mb-2">
                                <i class="fas fa-eye mr-2"></i>Input Observasi
                            </a>
                            <a href="{{ route('asesor.validasi') }}"
                                class="btn btn-success btn-block">
                                <i class="fas fa-check-circle mr-2"></i>Validasi Kompetensi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM PENILAIAN --}}
            <div class="col-lg-7">
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="fas fa-clipboard-check mr-2"></i>Form Penilaian</h6>
                    </div>
                    <div class="card-body">
                        @if ($unikoms->isEmpty())
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-2"></i>
                                Tidak ada unit kompetensi yang terdaftar untuk skema ini.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Unit Kompetensi</th>
                                            <th class="text-center">Kompeten</th>
                                            <th class="text-center">Belum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unikoms as $unikom)
                                            @php
                                                $nilai = $penilaians->get($unikom->id)->nilai ?? null;
                                            @endphp
                                            <tr>
                                                <td>{{ $unikom->unikom ?? $unikom->kode_unikom ?? '-' }}</td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="penilaian[{{ $unikom->id }}]"
                                                            id="kompeten_{{ $unikom->id }}"
                                                            value="kompeten"
                                                            {{ $nilai === 'kompeten' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label text-success"
                                                            for="kompeten_{{ $unikom->id }}">
                                                            <i class="fas fa-check-circle fa-lg"></i>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="penilaian[{{ $unikom->id }}]"
                                                            id="belum_{{ $unikom->id }}"
                                                            value="belum"
                                                            {{ $nilai === 'belum' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label text-danger"
                                                            for="belum_{{ $unikom->id }}">
                                                            <i class="fas fa-times-circle fa-lg"></i>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        {{-- CATATAN ASESOR --}}
                        <div class="form-group mt-4">
                            <label for="keterangan"><strong>Catatan Asesor</strong></label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="4"
                                placeholder="Catatan hasil penilaian...">{{ old('keterangan', $register->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-right">
                            <a href="{{ route('asesor.penilaian') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save mr-1"></i>Simpan Penilaian
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
