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
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">Rekomendasi Sertifikasi</li>
            </ol>
        </nav>
    </div>

    @include('layout.verifikasi')

    <div class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><i class="fas fa-list mr-2"></i>Daftar Peserta Rekomendasi</h6>
            <span class="badge badge-light">{{ $participants->count() }} peserta</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="order-listing" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Asesi</th>
                            <th>Skema Sertifikasi</th>
                            <th>Penilaian</th>
                            <th>Validasi</th>
                            <th>Status Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $i => $item)
                            @php
                                $totalNilai = $item->penilaians->count();
                                $kompetenNilai = $item->penilaians->where('nilai', 'kompeten')->count();
                                $vd = $item->validasi_data;
                                $rd = $item->rekomendasi_data;
                                $validated = !empty($vd['checklist']['bukti_lengkap'])
                                    && !empty($vd['checklist']['observasi_sesuai'])
                                    && !empty($vd['checklist']['nilai_konsisten']);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user_name ?? '-' }}</td>
                                <td>{{ $item->skema_name ?? '-' }}</td>
                                <td>
                                    @if ($totalNilai > 0)
                                        <span class="badge badge-{{ $kompetenNilai == $totalNilai ? 'success' : 'warning' }}">
                                            {{ $kompetenNilai }}/{{ $totalNilai }}
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($validated)
                                        <span class="badge badge-success">{{ $vd['status_akhir'] ?? 'Valid' }}</span>
                                    @else
                                        <span class="badge badge-secondary">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($rd && $rd['keputusan'])
                                        <span class="badge badge-{{ $rd['keputusan'] == 'Direkomendasikan Sertifikasi' ? 'success' : 'danger' }}">
                                            {{ $rd['keputusan'] }}
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">Belum Direkomendasikan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('asesor.rekomendasi.show', $item->id) }}"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-certificate"></i>
                                        {{ $rd && $rd['keputusan'] ? 'Lihat' : 'Rekomendasi' }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada peserta asesmen</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
