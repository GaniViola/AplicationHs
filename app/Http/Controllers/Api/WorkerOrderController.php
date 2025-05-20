<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class WorkerOrderController extends Controller
{
    public function index(Request $request)
    {
      $workerId = Auth::id();

        $orders = Orders::with(['user', 'orderDetails.service']) // relasi user dan detail layanan
            ->where('worker_id', $workerId)
            ->where('status', 'proses') // atau hapus baris ini jika mau semua status
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'message' => 'Daftar order untuk pekerja',
            'data' => $orders
        ]);
    }
}

