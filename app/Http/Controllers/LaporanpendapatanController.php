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
}
