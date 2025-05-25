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
        try {
            $workPhotos = WorkPhoto::with([
                'order.customer',
                'order.orderDetails.service',
                'worker'
            ])->latest()->get();
            // dd($workPhotos); 

            $pdf = Pdf::loadView('admin.pages.laporanpekerja_pdf', compact('workPhotos'));
            $pdfName = 'laporan_pendapatan_all_data.pdf';

            return $pdf->download($pdfName);
        } catch (\Exception $e) {
            Log::error('Error exporting PDF: ' . $e->getMessage());
        }
    }
}
