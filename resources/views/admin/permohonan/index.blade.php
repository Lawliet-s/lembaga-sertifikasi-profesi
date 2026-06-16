@extends('layout.admin')

@section('sidebar')
    sidebar-mini
@endsection

@section('judul')
    Registrasi Baru - {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-header">
        <h4><i class="fas fa-file-alt"></i> Registrasi Baru (FR.APL.01)</h4>
        <p class="text-muted">Kelola semua permohonan sertifikasi dari asesi.</p>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-color); color: #fff;">
            <span><i class="fas fa-list"></i> Daftar Permohonan</span>
            <span class="badge badge-light">{{ $permohonans->total() }} total</span>
        </div>
        <div class="card-body p-0">
            @if ($permohonans->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada permohonan sertifikasi dari asesi.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
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
                                    <td>
                                        <strong>{{ $item->user->name }}</strong>
                                        <br><small class="text-muted">{{ $item->user->email }}</small>
                                    </td>
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
                                        <span class="badge badge-{{ $badge }}">{{ ucfirst($item->status) }}</span>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.permohonan.show', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
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
