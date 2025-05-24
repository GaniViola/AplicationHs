<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pekerja</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .header p {
            font-size: 11px;
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #888;
            padding: 6px;
            font-size: 11px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .img-thumb {
            height: 80px;
            width: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Pekerja</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>

    @if($setorans->count())
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Pekerja</th>
                <th>Tanggal</th>
                <th>Jumlah Admin</th>
                <th>Foto Sebelum</th>
            </tr>
        </thead>
        <tbody>
            @foreach($setorans as $i => $setoran)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ $setoran->order_id }}</td>
                <td>{{ $setoran->order->customer->username ?? '-' }}</td>
                <td>{{ $setoran->worker->username ?? '-' }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($setoran->tanggal_setoran)->format('d-m-Y') }}</td>
                <td class="text-right">Rp {{ number_format($setoran->jumlah_admin, 0, ',', '.') }}</td>
                <td class="text-center">
                    @php
                        $photoPath = public_path('storage/work_photos/before/' . ($setoran->order->workPhoto->photo_before ?? ''));
                    @endphp
                    @if(file_exists($photoPath))
                        <img src="{{ 'file://' . $photoPath }}" class="img-thumb">
                    @else
                        Tidak Ada
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p style="text-align: center; padding: 50px 0;">Tidak ada data setoran dalam periode ini.</p>
    @endif
</body>
</html>
