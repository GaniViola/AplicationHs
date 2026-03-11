<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah ada parameter search
        $search = $request->query('search');
    
        // Jika ada search, filter
        if ($search) {
            $services = Service::where('name', 'like', '%' . $search . '%')->get();
        } else {
            // Jika tidak ada search, ambil semua
            $services = Service::all();
        }
    
        // Map data untuk memformat URL gambar dengan benar
        return response()->json([
            'status' => true,
            'message' => 'Daftar layanan berhasil diambil',
            'data' => $services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'category_id' => $service->category_id,
                    'name' => $service->name,
                    'description' => $service->description,
                    'price' => $service->price,
                    'image' => $service->image ? url('storage/' . $service->image) : null,  // memastikan URL gambar lengkap
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                ];
            })
        ]);
    }
}    
