<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkPhoto;

class WorkPhotoController extends Controller
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
}
