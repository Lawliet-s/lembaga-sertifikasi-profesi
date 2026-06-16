@extends('layout.asesor')

@section('judul')
Rekomendasi Sertifikasi | {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    <div class="page-header">
        <h4>
            <i class="fas fa-certificate"></i> Rekomendasi Sertifikasi
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('dashboard.asesor') }}">Asesor</a>
                </li>
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('asesor.rekomendasi') }}">Rekomendasi Sertifikasi</a>
                </li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">
                    {{ $register->user_name ?? 'Detail' }}
                </li>
            </ol>
        </nav>
    </div>

    @include('layout.verifikasi')

    <form action="{{ route('asesor.rekomendasi.store', $register->id) }}" method="POST">
        @csrf

        <div class="row">
            {{-- SISI KIRI --}}
            <div class="col-lg-5">
                {{-- INFORMASI HASIL --}}
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Informasi Hasil</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="45%"><strong>Nama Asesi</strong></td>
                                <td>: {{ $register->user_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Skema</strong></td>
                                <td>: {{ $register->skema_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status Kompetensi</strong></td>
                                <td>:
                                    @if ($totalKompeten + $totalBelum > 0)
                                        <span class="badge badge-{{ $totalBelum == 0 ? 'success' : 'danger' }}">
                                            {{ $totalKompeten }}/{{ $totalKompeten + $totalBelum }} Kompeten
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">Belum Dinilai</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- ALUR HUBUNGAN ANTAR MODUL --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-project-diagram mr-2"></i>Alur Hubungan Antar Modul</h6>
                    </div>
                    <div class="card-body">
                        <div class="small text-muted mb-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            Ini penting dipahami junior developer.
                        </div>
                        <div class="flow-chart">
                            <div class="flow-item">
                                <a href="{{ route('asesor.penilaian.show', $register->id) }}"
                                    class="btn btn-outline-danger btn-block text-left">
                                    <i class="fas fa-file-alt mr-2"></i>Penilaian Asesi
                                </a>
                                <div class="text-center text-muted my-1">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                            </div>
                            <div class="flow-item">
                                <a href="{{ route('asesor.observasi.show', $register->id) }}"
                                    class="btn btn-outline-warning btn-block text-left">
                                    <i class="fas fa-eye mr-2"></i>Input Observasi
                                </a>
                                <div class="text-center text-muted my-1">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                            </div>
                            <div class="flow-item">
                                <a href="{{ route('asesor.validasi.show', $register->id) }}"
                                    class="btn btn-outline-success btn-block text-left">
                                    <i class="fas fa-check-circle mr-2"></i>Validasi Kompetensi
                                </a>
                                <div class="text-center text-muted my-1">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                            </div>
                            <div class="flow-item">
                                <div class="btn btn-danger btn-block text-left disabled">
                                    <i class="fas fa-certificate mr-2"></i>Rekomendasi Sertifikasi
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 p-2 bg-light rounded small">
                            <strong>Artinya:</strong><br>
                            asesor memberi nilai &rarr; asesor mengamati praktik &rarr; sistem memvalidasi hasil &rarr; asesor memberi keputusan akhir
                        </div>
                    </div>
                </div>
            </div>

            {{-- SISI KANAN --}}
            <div class="col-lg-7">
                {{-- REKOMENDASI --}}
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="fas fa-gavel mr-2"></i>Rekomendasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><strong>Pilih Keputusan Akhir</strong></label>
                            @php
                                $keputusan = $rekomendasiData['keputusan'] ?? null;
                            @endphp
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="kep_1" name="keputusan"
                                    value="Direkomendasikan Sertifikasi" class="custom-control-input"
                                    {{ $keputusan == 'Direkomendasikan Sertifikasi' ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="kep_1">
                                    <span class="text-success font-weight-bold">Direkomendasikan Sertifikasi</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="kep_2" name="keputusan"
                                    value="Perlu Perbaikan" class="custom-control-input"
                                    {{ $keputusan == 'Perlu Perbaikan' ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="kep_2">
                                    <span class="text-warning font-weight-bold">Perlu Perbaikan</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="kep_3" name="keputusan"
                                    value="Mengulang Asesmen" class="custom-control-input"
                                    {{ $keputusan == 'Mengulang Asesmen' ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="kep_3">
                                    <span class="text-danger font-weight-bold">Mengulang Asesmen</span>
                                </label>
                            </div>
                            @error('keputusan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="catatan"><strong>Catatan Akhir</strong></label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="5"
                                placeholder="Catatan akhir asesor...">{{ old('catatan', $rekomendasiData['catatan'] ?? '') }}</textarea>
                            @error('catatan')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="text-right">
                            <a href="{{ route('asesor.rekomendasi') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save mr-1"></i>Simpan Rekomendasi
                            </button>
                        </div>
                    </div>
                </div>

                {{-- GENERATE PDF --}}
                @if ($rekomendasiData['keputusan'] ?? null)
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="mb-0"><i class="fas fa-file-pdf mr-2"></i>Generate PDF</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">
                            <i class="fas fa-download mr-1"></i>
                            Unduh dokumen hasil rekomendasi sertifikasi.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('asesor.rekomendasi.pdf', ['register' => $register->id, 'type' => 'berita-acara']) }}"
                                class="btn btn-outline-danger mr-2" target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i> Berita Acara
                            </a>
                            <a href="{{ route('asesor.rekomendasi.pdf', ['register' => $register->id, 'type' => 'hasil-asesmen']) }}"
                                class="btn btn-outline-danger" target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i> Hasil Asesmen
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
@endsection
