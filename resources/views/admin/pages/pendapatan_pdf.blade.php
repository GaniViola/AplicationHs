<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pendapatan Admin</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin-bottom: 5px;
        }
        .header p {
            margin: 2px 0;
            color: #555;
        }
        .summary {
            margin-bottom: 20px;
        }
        .summary-item {
            margin-bottom: 10px;
        }
        .summary-label {
            width: 200px;
            display: inline-block;
            font-weight: bold;
        }
        .summary-value {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th {
            background-color: #f8f9fa;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-success {
            color: #28a745;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #6c757d;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pendapatan Admin</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} sampai {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>

    @if($pendapatan && $pendapatan->total_transaksi > 0)
    <div class="summary">
        <div class="summary-item">
            <span class="summary-label">Total Pendapatan Admin:</span>
            <span class="summary-value">Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Transaksi:</span>
            <span class="summary-value">{{ $pendapatan->total_transaksi }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Setoran Terakhir:</span>
            <span class="summary-value">{{ $pendapatan->terakhir_setoran ? \Carbon\Carbon::parse($pendapatan->terakhir_setoran)->format('d-m-Y H:i') : '-' }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th class="text-center" width="15%">Tanggal</th>
                <th class="text-center" width="10%">Order ID</th>
                <th width="20%">Customer</th>
                <th width="20%">Pekerja</th>
                <th class="text-right" width="15%">Jumlah Setoran</th>
                <th class="text-right" width="15%">Untuk Admin</th>
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
                <td class="text-right text-success">Rp {{ number_format($setoran->jumlah_admin, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="text-align: center; padding: 50px 0;">
        <p style="font-size: 16px; color: #6c757d;">Tidak ada data setoran pada rentang tanggal yang dipilih.</p>
    </div>
    @endif

    <div class="footer">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem</p>
    </div>
</body>
</html>