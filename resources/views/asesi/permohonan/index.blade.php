@extends('layout.asesi')

@section('sidebar')
    sidebar-mini
@endsection

@section('judul')
    Permohonan Sertifikasi - {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-header">
        <h4><i class="fas fa-file-alt"></i> Permohonan Sertifikasi Kompetensi</h4>
    </div>

    <div class="card shadow-sm rounded mb-4">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-color); color: #fff;">
            <span><i class="fas fa-list"></i> Daftar Permohonan</span>
            @if ($permohonans->whereIn('status', ['pending', 'revisi'])->count() < 3)
                <a href="{{ route('permohonan.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus"></i> Ajukan Baru
                </a>
            @endif
        </div>
        <div class="card-body p-0">
            @if ($permohonans->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada permohonan sertifikasi.</p>
                    <a href="{{ route('permohonan.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Ajukan Permohonan
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Skema</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permohonans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->skema->skema ?? '-' }}</td>
                                    <td>
                                        @php
                                            $badge = match($item->status) {
                                                'pending' => 'warning',
                                                'diverifikasi' => 'info',
                                                'revisi' => 'danger',
                                                'ditolak' => 'dark',
                                                'selesai' => 'success',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="badge badge-{{ $badge }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if (in_array($item->status, ['diverifikasi', 'selesai']))
                                            <a href="{{ route('permohonan.frapl01.show', $item->id) }}" class="btn btn-sm btn-primary" title="Lihat FR.APL.01">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('permohonan.show', $item->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        @if (in_array($item->status, ['pending', 'revisi']))
                                            <a href="{{ route('permohonan.edit', $item->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($permohonans->hasPages())
                    <div class="p-3">
                        {{ $permohonans->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection


