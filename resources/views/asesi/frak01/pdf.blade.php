<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>FR.AK.01 - Persetujuan Asesmen dan Kerahasiaan</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.6; color: #000; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .header h3 { margin: 5px 0; font-size: 14pt; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 11pt; }
        hr { border: 1px solid #000; margin: 15px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table td { padding: 4px 8px; }
        .label { width: 120px; font-weight: bold; }
        .content { margin: 20px 0; text-align: justify; }
        .content ol { margin-left: 20px; }
        .content ol li { margin-bottom: 8px; }
        .signature-section { margin-top: 40px; }
        .signature-box { max-width: 300px; margin: 10px 0; }
        .signature-box img { max-width: 100%; max-height: 100px; }
        .footer { margin-top: 50px; }
        .footer table td { width: 50%; vertical-align: top; }
        .footer .signature-line { margin-top: 60px; border-top: 1px solid #000; width: 200px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h2>FR.AK.01</h2>
        <h3>PERSETUJUAN ASESMEN DAN KERAHASIAAN</h3>
        <p>Lembaga Sertifikasi Profesi (LSP) {{ $site_setting->title ?? '' }}</p>
    </div>
    <hr>
    <table>
        <tr><td class="label">Nama Asesi</td><td>: {{ $registration->user_name ?? Auth::user()->name }}</td></tr>
        <tr><td class="label">Skema Sertifikasi</td><td>: {{ $registration->skema_name }}</td></tr>
        <tr><td class="label">Kode Registrasi</td><td>: #{{ $registration->id }}</td></tr>
        <tr><td class="label">Asesor</td><td>: {{ $registration->asesor?->nama ?? '-' }}</td></tr>
        <tr><td class="label">TUK</td><td>: {{ $registration->tuk?->tuk ?? '-' }}</td></tr>
        <tr><td class="label">Tanggal</td><td>: {{ $frAk01->agreed_at->format('d M Y') }}</td></tr>
    </table>
    <hr>
    <div class="content">
        <p>Saya yang bertanda tangan di bawah ini dengan ini menyatakan bahwa:</p>
        <ol>
            <li>Saya telah membaca dan memahami seluruh informasi terkait proses asesmen sertifikasi kompetensi yang akan saya ikuti.</li>
            <li>Saya menyetujui untuk mengikuti seluruh rangkaian proses asesmen sesuai dengan ketentuan dan prosedur yang berlaku di LSP.</li>
            <li>Saya memberikan persetujuan kepada LSP {{ $site_setting->title ?? '' }} untuk menggunakan dan mengelola data pribadi saya untuk keperluan sertifikasi sesuai dengan peraturan perundang-undangan yang berlaku.</li>
            <li>Saya memahami bahwa hasil asesmen akan diumumkan sesuai prosedur yang berlaku di LSP.</li>
            <li>Saya bersedia menjaga kerahasiaan seluruh materi asesmen yang diberikan dan tidak akan menyebarluaskannya kepada pihak lain yang tidak berhak.</li>
            <li>Saya menyetujui bahwa keputusan asesor bersifat final dan mengikat selama sesuai dengan prosedur yang berlaku.</li>
        </ol>
    </div>
    <hr>
    <div class="signature-section">
        <table>
            <tr>
                <td style="width: 50%;">
                    <p><strong>Asesi,</strong></p>
                    @if ($frAk01->ttd_path)
                        <div class="signature-box">
                            <img src="{{ storage_path('app/public/' . $frAk01->ttd_path) }}" alt="Tanda Tangan">
                        </div>
                    @endif
                    <div class="signature-line"></div>
                    <p>{{ $registration->user_name ?? Auth::user()->name }}</p>
                    <p>Tanggal: {{ $frAk01->agreed_at->format('d M Y') }}</p>
                </td>
                <td style="width: 50%;">
                    <p><strong>Asesor,</strong></p>
                    <div class="signature-line"></div>
                    <p>{{ $registration->asesor?->nama ?? '-' }}</p>
                    <p>Tanggal: ................</p>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <p style="text-align: center; font-size: 10pt;">
        Dokumen ini telah ditandatangani secara elektronik oleh asesi pada {{ $frAk01->agreed_at->format('d M Y H:i') }}
    </p>
</body>
</html>
