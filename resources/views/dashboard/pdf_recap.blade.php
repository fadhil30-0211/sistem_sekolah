<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Layanan Digital - SMAN Okura</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; color: #0B192C; }
        .header { text-align: center; border-bottom: 2px solid #0B192C; padding-bottom: 8px; margin-bottom: 15px; }
        .title { font-size: 14pt; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        .table th { background-color: #F8F9FA; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN REKAPITULASI LAYANAN DIGITAL SCHOOL PORTAL</div>
        <div style="font-size: 11pt;">SMA NEGERI OKURA PEKANBARU</div>
        <div style="font-size: 8pt; color: #555;">Dicetak pada: {{ date('d F Y H:i') }} WIB</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Kode Tiket</th>
                <th style="width: 10%;">Jenis</th>
                <th style="width: 20%;">Nama Pemohon</th>
                <th style="width: 25%;">Judul Layanan</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $index => $ticket)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $ticket->ticket_code }}</strong></td>
                    <td>{{ $ticket->type }}</td>
                    <td>{{ $ticket->is_anonymous ? 'Anonim' : $ticket->nama_pemohon }}</td>
                    <td>{{ $ticket->judul_layanan }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
