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
use Illuminate\Support\Facades\Log;

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
    public function exportPdf(Request $request)
    {
        try{
        $startDate = $request->start_date;
        $endDate = $request->end_date;

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

        $pdf = Pdf::loadView('admin.pages.laporangajipekerja_pdf', [
            'gajiPerPekerja' => $gajiPerPekerja,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        return $pdf->download('laporan_gaji.pdf');
    }
            catch (\Exception $e) {
                Log::error('Error exporting PDF: ' . $e->getMessage());
            }
        }
    }




