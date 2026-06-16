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
                <li style="color: #fff" class="breadcrumb-item active" aria-current="page">Penilaian Asesi</li>
            </ol>
        </nav>
    </div>

    @include('layout.verifikasi')

    <div class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><i class="fas fa-list mr-2"></i>Daftar Peserta Asesmen</h6>
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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $i => $item)
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
                                    @php
                                        $status = strip_tags($item->status ?? 'Belum dinilai');
                                    @endphp
                                    @if (str_contains($status, 'Kompeten'))
                                        <span class="badge badge-success">{{ $status }}</span>
                                    @elseif (str_contains($status, 'Belum Kompeten'))
                                        <span class="badge badge-danger">{{ $status }}</span>
                                    @elseif (str_contains($status, 'Validasi'))
                                        <span class="badge badge-info">{{ $status }}</span>
                                    @elseif (str_contains($status, 'Observasi') || $item->koreksi)
                                        <span class="badge badge-warning">Observasi</span>
                                    @elseif ($status === 'Belum dinilai' || !$item->status)
                                        <span class="badge badge-secondary">Belum dinilai</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('asesor.penilaian.show', $item->id) }}"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-edit"></i> Nilai
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada peserta asesmen</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
