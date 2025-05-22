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
class LaporanpendapatanController extends Controller
{
        public function laporanPendapatan(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Setoran::select(
            DB::raw('SUM(jumlah_admin) as total_pendapatan'),
            DB::raw('COUNT(*) as total_transaksi'),
            DB::raw('MAX(tanggal_setoran) as terakhir_setoran')
        )->where('status_setoran', 'selesai');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_setoran', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $pendapatan = $query->first();

        // Ambil semua data setorannya juga (untuk tabel detail)
        $setorans = Setoran::with(['order.customer', 'worker'])
            ->where('status_setoran', 'selesai');

        if ($startDate && $endDate) {
            $setorans->whereBetween('tanggal_setoran', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $setorans = $setorans->orderBy('tanggal_setoran', 'desc')->get();

        return view('admin.pages.laporan-pendapatan', [
            'title' => 'Laporan Pendapatan Admin',
            'pendapatan' => $pendapatan,
            'setorans' => $setorans,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Get pendapatan data
        $pendapatan = DB::table('setorans')
            ->select(
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(jumlah_admin) as total_pendapatan'),
                DB::raw('MAX(tanggal_setoran) as terakhir_setoran')
            )
            ->whereBetween('tanggal_setoran', [$startDate, $endDate])
            ->first();

        // Get setoran details
        $setorans = Setoran::with(['order.customer', 'worker'])
            ->whereBetween('tanggal_setoran', [$startDate, $endDate])
            ->orderBy('tanggal_setoran', 'desc')
            ->get();

        $pdf = PDF::loadView('admin.pages.pendapatan_pdf', compact('pendapatan', 'setorans', 'startDate', 'endDate'));
        $pdfName = 'laporan_pendapatan_' . str_replace('-', '', $startDate) . '_' . str_replace('-', '', $endDate) . '.pdf';

        return $pdf->download($pdfName);
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $fileName = 'laporan_pendapatan_' . str_replace('-', '', $startDate) . '_' . str_replace('-', '', $endDate) . '.xlsx';

        return Excel::download(new PendapatanExport($startDate, $endDate), $fileName);
    }
}
