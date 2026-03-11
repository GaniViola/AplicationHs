<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Gaji Pekerja</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #aaa;
            padding: 6px;
            font-size: 11px;
        }
        table th {
            background-color: #f0f0f0;
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Gaji Pekerja</h2>
        <p>Periode:
            @if($startDate && $endDate)
                {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}
            @else
                Semua Periode
            @endif
        </p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>

    @if(count($gajiPerPekerja) > 0)
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pekerja</th>
                <th class="text-center">Jumlah Setoran</th>
                <th class="text-right">Total Gaji</th>
                <th class="text-center">Setoran Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gajiPerPekerja as $index => $gaji)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $gaji->worker->username ?? '-' }}</td>
                <td class="text-center">{{ $gaji->jumlah_setoran }}</td>
                <td class="text-right">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($gaji->terakhir_setor)->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; margin-top: 100px; font-size: 14px;">Tidak ada data gaji pada periode ini.</p>
    @endif
</body>
</html>
