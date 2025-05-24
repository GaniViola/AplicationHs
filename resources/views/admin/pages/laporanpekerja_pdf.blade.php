<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pekerja</title>
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
        .summary {
            margin-top: 20px;
            font-size: 12px;
        }
        .summary div {
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Pendapatan Pekerja</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>

    @if($pendapatan && $pendapatan->total_transaksi > 0)
        <div class="summary">
            <div><strong>Total Transaksi:</strong> {{ $pendapatan->total_transaksi }}</div>
            <div><strong>Total Pendapatan Admin:</strong> Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</div>
            <div><strong>Setoran Terakhir:</strong> {{ \Carbon\Carbon::parse($pendapatan->terakhir_setoran)->format('d-m-Y H:i') }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Pekerja</th>
                    <th class="text-right">Jumlah Setoran</th>
                    <th class="text-right">Untuk Admin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($setorans as $index => $setoran)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($setoran->tanggal_setoran)->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $setoran->order_id }}</td>
                    <td>{{ $setoran->order->customer->username ?? '-' }}</td>
                    <td>{{ $setoran->worker->username ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($setoran->jumlah_setoran, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($setoran->jumlah_admin, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; margin-top: 100px; font-size: 14px;">Tidak ada data setoran pada periode ini.</p>
    @endif
</body>
</html>
