<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendapatanExport;
use Barryvdh\DomPDF\Facade\Pdf;
class LaporangajiController extends Controller
{
        public function laporanGaji(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Setoran::select(
                'worker_id',
                DB::raw('SUM(jumlah_pekerja) as total_gaji'),
                DB::raw('COUNT(*) as jumlah_setoran'),
                DB::raw('MAX(tanggal_setoran) as terakhir_setor')
            )
            ->where('status_setoran', 'selesai')
            ->with('worker')
            ->groupBy('worker_id');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_setoran', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $gajiPerPekerja = $query->get();

        return view('admin.pages.laporan-gaji', [
            'title' => 'Laporan Gaji Pekerja',
            'gajiPerPekerja' => $gajiPerPekerja,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
