@extends('layout.asesi')

@section('sidebar')
    sidebar-mini
@endsection

@section('judul')
    Status Permohonan - {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-file-alt"></i> Status Permohonan</h4>
        <a href="{{ route('permohonan.create') }}" class="btn" style="background-color: var(--primary-color); color: #fff;">
            <i class="fas fa-plus"></i> Ajukan Baru
        </a>
    </div>

    <div class="card shadow-sm rounded mb-4">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-color); color: #fff;">
            <span><i class="fas fa-list"></i> Daftar Status Permohonan</span>
        </div>
        <div class="card-body p-0">
            @if ($permohonans->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada permohonan.</p>
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
                                            <a href="{{ route('permohonan.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        @if ($item->status === 'pending')
                                            <form method="POST" action="{{ route('permohonan.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin membatalkan permohonan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Batalkan">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if (in_array($item->status, ['pending', 'revisi']))
                                            <a href="{{ route('permohonan.edit', $item->id) }}" class="btn btn-sm btn-success" title="Edit">
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


