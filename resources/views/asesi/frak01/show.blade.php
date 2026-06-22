@extends('layout.asesi')

@section('sidebar')
    sidebar-mini
@endsection

@section('judul')
    FR.AK.01 - Persetujuan Asesmen dan Kerahasiaan - {{ $site_setting->title ?? 'LSP' }}
@endsection

@section('isi')
<div class="container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h4><i class="fas fa-file-signature"></i> FR.AK.01 — Persetujuan Asesmen dan Kerahasiaan</h4>
        <a href="{{ route('frak01.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm rounded mb-4">
        <div class="card-header" style="background-color: var(--primary-color); color: #fff;">
            <i class="fas fa-info-circle"></i> Informasi Pendaftaran
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="fw-bold" style="width: 140px;">Skema</td>
                            <td>: {{ $registration->skema_name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Kode Registrasi</td>
                            <td>: #{{ $registration->id }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal Daftar</td>
                            <td>: {{ $registration->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="fw-bold" style="width: 140px;">Asesor</td>
                            <td>: {{ $registration->asesor?->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">TUK</td>
                            <td>: {{ $registration->tuk?->tuk ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Nama Asesi</td>
                            <td>: {{ Auth::user()->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($frAk01 && $frAk01->status === 'signed')
        <div class="card shadow-sm rounded mb-4">
            <div class="card-header" style="background-color: #28a745; color: #fff;">
                <i class="fas fa-check-circle"></i> Dokumen Telah Ditandatangani
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    FR.AK.01 telah ditandatangani pada tanggal
                    <strong>{{ $frAk01->agreed_at->format('d M Y H:i') }}</strong>.
                </div>

                <h5 class="mb-3" style="color: var(--primary-color);">
                    <i class="fas fa-file-contract"></i> Pernyataan Persetujuan
                </h5>

                <div class="border rounded p-4 mb-4" style="background: #f8f9fa;">
                    <p>Saya yang bertanda tangan di bawah ini:</p>
                    <p><strong>Nama</strong> : {{ Auth::user()->name }}</p>
                    <p><strong>Skema</strong> : {{ $registration->skema_name }}</p>
                    <hr>
                    <p>Dengan ini menyatakan bahwa:</p>
                    <ol>
                        <li>Saya telah membaca dan memahami seluruh informasi terkait proses asesmen sertifikasi kompetensi.</li>
                        <li>Saya menyetujui untuk mengikuti seluruh rangkaian proses asesmen sesuai dengan ketentuan yang berlaku.</li>
                        <li>Saya memberikan persetujuan kepada LSP untuk menggunakan data pribadi saya untuk keperluan sertifikasi sesuai dengan ketentuan kerahasiaan yang berlaku.</li>
                        <li>Saya memahami bahwa hasil asesmen akan diumumkan sesuai prosedur yang berlaku.</li>
                        <li>Saya bersedia menjaga kerahasiaan seluruh materi asesmen yang diberikan.</li>
                    </ol>
                </div>

                <h5 class="mb-3" style="color: var(--primary-color);">
                    <i class="fas fa-pen"></i> Tanda Tangan
                </h5>
                <div class="border rounded p-3 mb-3" style="background: #f8f9fa; max-width: 400px;">
                    @if ($frAk01->ttd_path)
                        <img src="{{ asset('storage/' . $frAk01->ttd_path) }}" alt="Tanda Tangan" style="max-width: 100%; max-height: 150px;">
                    @elseif ($frAk01->ttd)
                        <img src="{{ $frAk01->ttd }}" alt="Tanda Tangan" style="max-width: 100%; max-height: 150px;">
                    @endif
                </div>
                <p class="text-muted">
                                    <small>Ditandatangani pada: {{ $frAk01->agreed_at->format('d M Y H:i') }}</small>
                                </p>

                                <a href="{{ route('frak01.pdf', $registration->id) }}" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('frak01.store', $registration->id) }}" method="POST" id="formFrak01">
                            @csrf

                            <div class="card shadow-sm rounded mb-4">
                                <div class="card-header" style="background-color: var(--primary-color); color: #fff;">
                                    <i class="fas fa-file-contract"></i> Pernyataan Persetujuan
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-4 mb-4" style="background: #f8f9fa;">
                                        <p>Saya yang bertanda tangan di bawah ini:</p>
                                        <p><strong>Nama</strong> : {{ Auth::user()->name }}</p>
                                        <p><strong>Skema</strong> : {{ $registration->skema_name }}</p>
                                        <hr>
                                        <p>Dengan ini menyatakan bahwa:</p>
                                        <ol>
                                            <li>Saya telah membaca dan memahami seluruh informasi terkait proses asesmen sertifikasi kompetensi.</li>
                                            <li>Saya menyetujui untuk mengikuti seluruh rangkaian proses asesmen sesuai dengan ketentuan yang berlaku.</li>
                                            <li>Saya memberikan persetujuan kepada LSP untuk menggunakan data pribadi saya untuk keperluan sertifikasi sesuai dengan ketentuan kerahasiaan yang berlaku.</li>
                                            <li>Saya memahami bahwa hasil asesmen akan diumumkan sesuai prosedur yang berlaku.</li>
                                            <li>Saya bersedia menjaga kerahasiaan seluruh materi asesmen yang diberikan.</li>
                                        </ol>
                                    </div>

                                    <h5 class="mb-3" style="color: var(--primary-color);">
                                        <i class="fas fa-pen"></i> Tanda Tangan
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <label class="form-label small fw-bold">Tanda Tangan Asesi <span class="text-danger">*</span></label>
                                            <div class="border rounded p-2" style="background: #fff;">
                                                <canvas id="signatureCanvas" width="600" height="200"
                                                    style="width: 100%; height: 200px; border: 1px solid #dee2e6; border-radius: 4px; cursor: crosshair; touch-action: none;"></canvas>
                                            </div>
                                            <input type="hidden" name="ttd" id="ttdInput">
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearSignature()">
                                                    <i class="fas fa-eraser"></i> Hapus Tanda Tangan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-end px-4 py-3">
                                    <button type="submit" class="btn" style="background-color: var(--primary-color); color: #fff;" onclick="return saveSignature()">
                                        <i class="fas fa-check"></i> Setuju & Tanda Tangan
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                @endsection

                @push('scripts')
                <script>
                    const canvas = document.getElementById('signatureCanvas');
                    if (canvas) {
                        const ctx = canvas.getContext('2d');
                        let drawing = false;
                        let lastX = 0;
                        let lastY = 0;

                        function getPos(e) {
                            const rect = canvas.getBoundingClientRect();
                            const scaleX = canvas.width / rect.width;
                            const scaleY = canvas.height / rect.height;
                            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                            return {
                                x: (clientX - rect.left) * scaleX,
                                y: (clientY - rect.top) * scaleY
                            };
                        }

                        canvas.addEventListener('mousedown', (e) => {
                            drawing = true;
                            const pos = getPos(e);
                            lastX = pos.x;
                            lastY = pos.y;
                            ctx.beginPath();
                            ctx.moveTo(lastX, lastY);
                        });

                        canvas.addEventListener('mousemove', (e) => {
                            if (!drawing) return;
                            const pos = getPos(e);
                            ctx.lineWidth = 2;
                            ctx.lineCap = 'round';
                            ctx.strokeStyle = '#000';
                            ctx.lineTo(pos.x, pos.y);
                            ctx.stroke();
                            lastX = pos.x;
                            lastY = pos.y;
                        });

                        canvas.addEventListener('mouseup', () => { drawing = false; });
                        canvas.addEventListener('mouseleave', () => { drawing = false; });

                        canvas.addEventListener('touchstart', (e) => {
                            e.preventDefault();
                            drawing = true;
                            const pos = getPos(e);
                            lastX = pos.x;
                            lastY = pos.y;
                            ctx.beginPath();
                            ctx.moveTo(lastX, lastY);
                        });

                        canvas.addEventListener('touchmove', (e) => {
                            e.preventDefault();
                            if (!drawing) return;
                            const pos = getPos(e);
                            ctx.lineWidth = 2;
                            ctx.lineCap = 'round';
                            ctx.strokeStyle = '#000';
                            ctx.lineTo(pos.x, pos.y);
                            ctx.stroke();
                            lastX = pos.x;
                            lastY = pos.y;
                        });

                        canvas.addEventListener('touchend', (e) => { e.preventDefault(); drawing = false; });
                    }

                    function clearSignature() {
                        const c = document.getElementById('signatureCanvas');
                        if (!c) return;
                        const ctx = c.getContext('2d');
                        ctx.clearRect(0, 0, c.width, c.height);
                        document.getElementById('ttdInput').value = '';
                    }

                    function saveSignature() {
                        const c = document.getElementById('signatureCanvas');
                        if (!c) return true;
                        const dataUrl = c.toDataURL('image/png');
                        document.getElementById('ttdInput').value = dataUrl;

                        const blankCanvas = document.createElement('canvas');
                        blankCanvas.width = c.width;
                        blankCanvas.height = c.height;
                        const blankData = blankCanvas.toDataURL('image/png');

                        if (dataUrl === blankData) {
                            alert('Silakan isi tanda tangan terlebih dahulu.');
                            return false;
                        }
                        return true;
                    }
                </script>
                @endpush
