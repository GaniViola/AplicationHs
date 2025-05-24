<?php
namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Http\Request;
use App\Models\WorkPhoto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LaporanpekerjaController extends Controller
{
   public function index()
{
    $title = 'Laporan Pekerja';
    $workPhotos = WorkPhoto::with([
        'order.customer',
        'order.orderDetails.service',
        'worker'
    ])->latest()->get();

    // Debug untuk menemukan lokasi file
    foreach ($workPhotos as $foto) {
        if ($foto->photo_before) {
            $possiblePaths = [
                storage_path('app/public/work_photos/before/' . $foto->photo_before),
                storage_path('app/work_photos/before/' . $foto->photo_before),
                storage_path('app/public/before/' . $foto->photo_before),
                storage_path('app/before/' . $foto->photo_before),
                public_path('storage/work_photos/before/' . $foto->photo_before),
                public_path('uploads/work_photos/before/' . $foto->photo_before)
            ];

            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $foto->real_path_before = $path;
                    break;
                }
            }
        }
    }

    return view('admin.pages.laporanpekerja', compact('workPhotos', 'title'));
    }
        public function exportPdf(Request $request)
    {
        try{
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

        $pdf = Pdf::loadView('admin.pages.laporanpekerja_pdf', compact('pendapatan', 'setorans', 'startDate', 'endDate'));
        $pdfName = 'laporan_pendapatan_' . str_replace('-', '', $startDate) . '_' . str_replace('-', '', $endDate) . '.pdf';

        return $pdf->download($pdfName);
            }
            catch (\Exception $e) {
                Log::error('Error exporting PDF: ' . $e->getMessage());
            }
    }
}
