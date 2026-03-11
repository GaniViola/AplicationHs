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

        th,
        td {
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
        <p>Semua Data</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </div>

    @if ($workPhotos->count())
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Foto Sebelum</th>
                    <th class="text-center">Foto Sesudah</th>
                    <th>Customer</th>
                    <th>Pekerja</th>
                    <th>Layanan</th>
                    <th>Catatan</th>
                    <th class="text-center">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workPhotos as $i => $wp)
                    @php
                        $order = $wp->order;
                        $details = $order->orderDetails ?? collect();
                        $layanan = optional($details->first())->service->name ?? '-';
                    @endphp
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td class="text-center">
                            @php
                                $photoFile = $wp->photo_before ?? null;
                                $photoUrl = $photoFile ? public_path('storage/' . $photoFile) : null;
                            @endphp
                            @if ($photoUrl)
                                <img src="{{ $photoUrl }}" class="img-thumb">
                            @else
                                Tidak Ada
                            @endif
                        </td>
                        <td class="text-center">
                            @php
                                $photoFile = $wp->photo_after ?? null;
                                $photoUrl = $photoFile ? public_path('storage/' . $photoFile) : null;
                            @endphp
                            @if ($photoUrl)
                                <img src="{{ $photoUrl }}" class="img-thumb">
                            @else
                                Tidak Ada
                            @endif
                        </td>
                        <td class="text-center">{{ $wp->order->customer->username }}</td>
                        <td>{{ $wp->worker->username ?? '-' }}</td>
                        <td class="text-center">{{ $layanan}}</td>

                        {{-- <td>{{ $wp->worker->username ?? '-' }}</td> --}}
                        <td>{{ $wp->catatan ?? '-' }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($wp->created_at)->format('d-m-Y') }}
                        </td>
                        {{-- <td class="text-right">Rp {{ number_format($wp->jumlah_admin, 0, ',', '.') }}</td> --}}
                        {{-- <td class="text-right">{{ $wp }}</td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; padding: 50px 0;">Tidak ada data setoran.</p>
    @endif
</body>

</html>
