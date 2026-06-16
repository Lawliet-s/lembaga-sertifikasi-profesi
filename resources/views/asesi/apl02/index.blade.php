@extends('layout.asesi')

@section('sidebar')
    sidebar-mini
@endsection

@section('judul')
    FR.APL.02 - Asesmen Mandiri - {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-clipboard-check"></i> FR.APL.02 — Asesmen Mandiri</h4>
    </div>

    <div class="card shadow-sm rounded mb-4">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-color); color: #fff;">
            <span><i class="fas fa-list"></i> Daftar Sertifikasi</span>
        </div>
        <div class="card-body p-0">
            @if ($registrations->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada sertifikasi yang divalidasi.</p>
                    <p class="text-muted small">Anda dapat mengisi FR.APL.02 setelah pendaftaran sertifikasi Anda divalidasi.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Skema</th>
                                <th>Kode Registrasi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $item)
                                @php
                                    $hasXnxx = \App\Models\Xnxx::where('data_register_id', $item->id)
                                        ->where('user_id', auth()->user()->id)
                                        ->exists();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->skema_name }}</td>
                                    <td><code>#{{ $item->id }}</code></td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>{!! $item->status !!}</td>
                                    <td>
                                        @if ($hasXnxx)
                                            <a href="{{ route('apl02.show', $item->id) }}" class="btn btn-sm btn-primary" title="Lihat APL.02">
                                                <i class="fas fa-eye"></i> Lihat APL.02
                                            </a>
                                        @else
                                            <a href="{{ route('apl02.create', $item->id) }}" class="btn btn-sm btn-success" title="Isi APL.02">
                                                <i class="fas fa-edit"></i> Isi APL.02
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
