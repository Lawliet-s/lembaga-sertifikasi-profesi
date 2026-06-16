@extends('layout.asesor')

@section('judul')
Input Observasi | {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('sidebar')
    sidebar-mini
@endsection

@section('isi')
    <div class="page-header">
        <h4>
            <i class="fas fa-eye"></i> Input Observasi
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom bg-danger">
                <li style="color: var(--secondary-color)" class="breadcrumb-item">
                    <a href="{{ route('dashboard.asesor') }}">Asesor</a>
                </li>
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">Input Observasi</li>
            </ol>
        </nav>
    </div>

    @include('layout.verifikasi')

    <div class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><i class="fas fa-list mr-2"></i>Daftar Peserta Observasi</h6>
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
                            <th>Jadwal</th>
                            <th>Status Observasi</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $i => $item)
                            @php
                                $latestObservasi = $item->observasis->first();
                                $totalNilai = $item->penilaians->count();
                                $kompetenNilai = $item->penilaians->where('nilai', 'kompeten')->count();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user_name ?? '-' }}</td>
                                <td>{{ $item->skema_name ?? '-' }}</td>
                                <td>
                                    @if ($item->date)
                                        {{ optional($item->date)->format('d/m/Y') }}
                                        @if ($item->time)
                                            <br><small>{{ $item->time }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">Belum dijadwalkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($latestObservasi)
                                        <span class="badge badge-success">Sudah Observasi</span>
                                    @else
                                        <span class="badge badge-secondary">Belum Observasi</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($totalNilai > 0)
                                        <span class="badge badge-{{ $kompetenNilai == $totalNilai ? 'success' : 'warning' }}">
                                            {{ $kompetenNilai }}/{{ $totalNilai }} Kompeten
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('asesor.observasi.show', $item->id) }}"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-eye"></i>
                                        {{ $latestObservasi ? 'Lihat' : 'Observasi' }}
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
