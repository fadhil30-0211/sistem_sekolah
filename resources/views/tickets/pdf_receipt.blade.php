<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resi Tiket - {{ $ticket->ticket_code }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; color: #0B192C; margin: 0; padding: 10px; }
        .header { border-bottom: 2px solid #1E5128; padding-bottom: 10px; margin-bottom: 15px; }
        .title { font-size: 16pt; font-weight: bold; color: #0B192C; }
        .subtitle { font-size: 9pt; color: #555; }
        .box { border: 1px solid #ccc; padding: 12px; border-radius: 6px; background: #F8F9FA; margin-bottom: 15px; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { padding: 4px 0; vertical-align: top; }
        .qr-section { text-align: right; }
        .footer { text-align: center; font-size: 8pt; color: #777; border-top: 1px solid #ddd; padding-top: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <table style="width:100%;">
            <tr>
                <td>
                    <div class="title">SMA NEGERI OKURA</div>
                    <div class="subtitle">Tebing Tinggi Okura, Rumbai Timur, Pekanbaru</div>
                    <div class="subtitle">Bukti Tanda Terima Layanan Digital (Resi Resmi)</div>
                </td>
                <td style="text-align: right; font-weight: bold; font-size: 14pt; color: #1E5128;">
                    {{ $ticket->type }}
                </td>
            </tr>
        </table>
    </div>

    <div class="box">
        <table class="table">
            <tr>
                <td style="width: 70%;">
                    <p style="margin: 0; font-size: 8pt; color: #666;">KODE TIKET UNIVERSAL</p>
                    <p style="margin: 2px 0 10px 0; font-size: 14pt; font-weight: bold; color: #0B192C;">{{ $ticket->ticket_code }}</p>

                    <p style="margin: 0; font-size: 8pt; color: #666;">NAMA PEMOHON</p>
                    <p style="margin: 2px 0 10px 0; font-weight: bold;">{{ $ticket->is_anonymous ? 'ANONIM' : $ticket->nama_pemohon }}</p>

                    <p style="margin: 0; font-size: 8pt; color: #666;">LAYANAN / KEPERLUAN</p>
                    <p style="margin: 2px 0 0 0;">{{ $ticket->judul_layanan }}</p>
                </td>
                <td class="qr-section" style="width: 30%;">
                    <div>{!! $qrCode !!}</div>
                    <p style="font-size: 7pt; color: #666; margin-top: 4px;">Pindai untuk Lacak</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="table">
        <tr>
            <td style="width: 50%;">
                <p style="font-size: 8pt; margin:0;">Tanggal Pengajuan: <strong>{{ $ticket->created_at->format('d/m/Y H:i') }} WIB</strong></p>
                <p style="font-size: 8pt; margin:2px 0 0 0;">Status Saat Ini: <strong>{{ strtoupper($ticket->status) }}</strong></p>
            </td>
            <td style="text-align: right; font-size: 8pt;">
                <p style="margin:0;">Simpan resi ini untuk melakukan pengecekan status secara berkala.</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        Resi ini sah dan dicetak secara otomatis oleh Portal Resmi SMAN Okura • KKN Kelompok 10 GOKURA USTI 2026
    </div>
</body>
</html>
