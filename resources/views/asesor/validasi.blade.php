@extends('layout.asesor')

@section('judul')
Validasi Kompetensi | {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    <div class="page-header">
        <h4>
            <i class="fas fa-check-circle"></i> Validasi Kompetensi
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('dashboard.asesor') }}">Asesor</a>
                </li>
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('asesor.validasi') }}">Validasi Kompetensi</a>
                </li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">
                    {{ $register->user_name ?? 'Detail' }}
                </li>
            </ol>
        </nav>
    </div>

    @include('layout.verifikasi')

    <form action="{{ route('asesor.validasi.store', $register->id) }}" method="POST">
        @csrf

        <div class="row">
            {{-- SISI KIRI --}}
            <div class="col-lg-5">
                {{-- INFORMASI ASESI --}}
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
                            @if ($register->tuk)
                            <tr>
                                <td><strong>TUK</strong></td>
                                <td>: {{ $register->tuk?->tuk ?? $register->tuk?->alamat ?? '-' }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                {{-- RINGKASAN PENILAIAN --}}
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white">
                        <h6 class="mb-0"><i class="fas fa-clipboard-check mr-2"></i>Ringkasan Penilaian</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <h3 class="text-success mb-0">{{ $totalKompeten }}</h3>
                                    <small class="text-muted">Total Kompeten</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <h3 class="text-danger mb-0">{{ $totalBelum }}</h3>
                                    <small class="text-muted">Total Belum Kompeten</small>
                                </div>
                            </div>
                        </div>
                        @if ($totalKompeten + $totalBelum > 0)
                            <div class="mt-3">
                                <a href="{{ route('asesor.penilaian.show', $register->id) }}"
                                    class="btn btn-outline-warning btn-block">
                                    <i class="fas fa-file-alt mr-2"></i>Lihat Detail Penilaian
                                </a>
                            </div>
                        @else
                            <div class="alert alert-info mt-3 mb-0">
                                <small><i class="fas fa-info-circle mr-1"></i>Belum ada penilaian.</small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- RINGKASAN OBSERVASI --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-eye mr-2"></i>Ringkasan Observasi</h6>
                    </div>
                    <div class="card-body">
                        @if ($observasi)
                            <div class="mb-3">
                                <label class="text-muted small mb-1"><strong>Bukti Observasi</strong></label>
                                <div>
                                    @if ($observasi->file)
                                        <a href="{{ asset('storage/' . $observasi->file) }}" target="_blank"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-download"></i> Download Bukti
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada file bukti</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="text-muted small mb-1"><strong>Catatan Asesor</strong></label>
                                <div class="p-2 bg-light rounded">
                                    <p class="mb-0">{{ $observasi->catatan ?? '-' }}</p>
                                </div>
                            </div>
                            @if ($observasi->aktivitas)
                                <div class="mt-3">
                                    <label class="text-muted small mb-1"><strong>Aktivitas Observasi</strong></label>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Aktivitas</th>
                                                    <th>Hasil</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($observasi->aktivitas as $akt)
                                                    <tr>
                                                        <td>{{ $akt['nama'] ?? '-' }}</td>
                                                        <td>
                                                            <span class="badge badge-{{ ($akt['hasil'] ?? '') == 'Baik' ? 'success' : (($akt['hasil'] ?? '') == 'Cukup' ? 'warning' : 'danger') }}">
                                                                {{ $akt['hasil'] ?? '-' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                            <div class="mt-3">
                                <a href="{{ route('asesor.observasi.show', $register->id) }}"
                                    class="btn btn-outline-info btn-block">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail Observasi
                                </a>
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                <small><i class="fas fa-info-circle mr-1"></i>Belum ada observasi.</small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- HUBUNGAN DENGAN MODUL LAIN --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-link mr-2"></i>Hubungan dengan Modul Lain</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small mb-2">
                                <i class="fas fa-arrow-down text-success mr-1"></i>
                                <strong>Mengambil Data dari:</strong>
                            </label>
                            <div class="p-2 bg-light rounded">
                                <a href="{{ route('asesor.penilaian.show', $register->id) }}"
                                    class="btn btn-outline-danger btn-block text-left mb-2">
                                    <i class="fas fa-file-alt mr-2"></i>Penilaian Asesi
                                </a>
                                <a href="{{ route('asesor.observasi.show', $register->id) }}"
                                    class="btn btn-outline-warning btn-block text-left">
                                    <i class="fas fa-eye mr-2"></i>Input Observasi
                                </a>
                            </div>
                        </div>
                        <div>
                            <label class="text-muted small mb-2">
                                <i class="fas fa-arrow-up text-warning mr-1"></i>
                                <strong>Mengirim Hasil ke:</strong>
                            </label>
                            <div class="p-2 bg-light rounded">
                                <a href="{{ route('asesor.rekomendasi') }}"
                                    class="btn btn-outline-success btn-block text-left">
                                    <i class="fas fa-certificate mr-2"></i>Rekomendasi Sertifikasi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SISI KANAN --}}
            <div class="col-lg-7">
                {{-- CHECKLIST VALIDASI --}}
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="fas fa-tasks mr-2"></i>Checklist Validasi</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $ck = $validasiData['checklist'] ?? [];
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Validasi</th>
                                        <th class="text-center" style="width: 120px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bukti lengkap</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="bukti_lengkap"
                                                    name="checklist[bukti_lengkap]" value="1"
                                                    {{ !empty($ck['bukti_lengkap']) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="bukti_lengkap">
                                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Observasi sesuai</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="observasi_sesuai"
                                                    name="checklist[observasi_sesuai]" value="1"
                                                    {{ !empty($ck['observasi_sesuai']) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="observasi_sesuai">
                                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai konsisten</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="nilai_konsisten"
                                                    name="checklist[nilai_konsisten]" value="1"
                                                    {{ !empty($ck['nilai_konsisten']) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="nilai_konsisten">
                                                    <i class="fas fa-check-circle text-success fa-lg"></i>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @error('checklist.bukti_lengkap')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                        @error('checklist.observasi_sesuai')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                        @error('checklist.nilai_konsisten')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- STATUS AKHIR --}}
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <h6 class="mb-0"><i class="fas fa-flag-checkered mr-2"></i>Status Akhir</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><strong>Pilih Status Validasi</strong></label>
                            <div class="d-flex gap-3">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="status_kompeten" name="status_akhir"
                                        value="Kompeten" class="custom-control-input"
                                        {{ ($validasiData['status_akhir'] ?? '') == 'Kompeten' ? 'checked' : '' }}
                                        required>
                                    <label class="custom-control-label" for="status_kompeten">
                                        <span class="text-success font-weight-bold">Kompeten</span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status_belum" name="status_akhir"
                                        value="Belum Kompeten" class="custom-control-input"
                                        {{ ($validasiData['status_akhir'] ?? '') == 'Belum Kompeten' ? 'checked' : '' }}
                                        required>
                                    <label class="custom-control-label" for="status_belum">
                                        <span class="text-danger font-weight-bold">Belum Kompeten</span>
                                    </label>
                                </div>
                            </div>
                            @error('status_akhir')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="text-right">
                            <a href="{{ route('asesor.validasi') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save mr-1"></i>Simpan Validasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('foot')
<script>
    document.querySelectorAll('input[type=checkbox]').forEach(cb => {
        cb.addEventListener('change', function() {
            const icon = this.nextElementSibling.querySelector('i');
            if (this.checked) {
                icon.className = 'fas fa-check-circle text-success fa-lg';
            } else {
                icon.className = 'fas fa-check-circle text-muted fa-lg';
            }
        });
        if (!cb.checked) {
            const icon = cb.nextElementSibling.querySelector('i');
            icon.className = 'fas fa-check-circle text-muted fa-lg';
        }
    });
</script>
@endsection
