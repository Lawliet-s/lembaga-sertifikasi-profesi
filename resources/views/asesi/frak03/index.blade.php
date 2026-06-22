@extends('layout.asesi')

@section('sidebar')
    sidebar-mini
@endsection

@section('judul')
    FR.AK.03 - Umpan Balik dan Catatan Asesmen - {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-comment-dots"></i> FR.AK.03 — Umpan Balik dan Catatan Asesmen</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><i class="fas fa-table"></i> Daftar Sertifikasi Selesai</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive table-striped">
                        <div id="order-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="order-listing" class="table dataTable no-footer" role="grid"
                                        aria-describedby="order-listing_info">
                                        <thead>
                                            <tr class="bg-danger text-white" role="row">
                                                <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" style="width: 10px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" style="width: 80px;">Aksi</th>
                                                <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" style="width: 200px;">Skema</th>
                                                <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" style="width: 100px;">Kode Reg</th>
                                                <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" style="width: 100px;">Tanggal Selesai</th>
                                                <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" style="width: 100px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($registrations as $item)
                                                @php $frAk03 = $item->frAk03; @endphp
                                                <tr role="row" class="odd">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-right">
                                                        @if ($frAk03)
                                                            <a href="{{ route('frak03.show', $item->id) }}" class="btn btn-primary btn-sm" title="Lihat">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        @else
                                                            <a href="{{ route('frak03.show', $item->id) }}" class="btn btn-success btn-sm" title="Isi Umpan Balik">
                                                                <i class="fas fa-edit"></i> Isi
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td class="font-weight-bold">{{ $item->skema_name }}</td>
                                                    <td><code>#{{ $item->id }}</code></td>
                                                    <td>{{ $item->updated_at->format('d M Y') }}</td>
                                                    <td>
                                                        @if ($frAk03)
                                                            <span class="badge" style="background-color: #28a745; color: #fff;">
                                                                <i class="fas fa-check"></i> Sudah diisi
                                                            </span>
                                                        @else
                                                            <span class="badge" style="background-color: #ffc107; color: #000;">
                                                                <i class="fas fa-clock"></i> Belum diisi
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr role="row">
                                                    <td colspan="6" class="text-center py-4 text-muted">
                                                        <i class="fas fa-clipboard-check fa-2x mb-2"></i><br>
                                                        Belum ada sertifikasi yang selesai.<br>
                                                        <small>FR.AK.03 akan tersedia setelah proses sertifikasi selesai.</small>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
