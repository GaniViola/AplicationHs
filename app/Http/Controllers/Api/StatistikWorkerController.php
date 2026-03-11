<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;

class StatistikWorkerController extends Controller
{
    public function index()
    {
        $workerId = Auth::id();

        $orders = Orders::where('worker_id', $workerId);

        $totalOrders = $orders->count();
        $completedOrders = $orders->where('status', 'selesai')->count();
        $totalPendapatan = $orders->where('status', 'selesai')->sum('total_pembayaran');

        $completionRate = $totalOrders > 0
            ? round(($completedOrders / $totalOrders) * 100, 2)
            : 0;

        return response()->json([
            'total_orders' => $totalOrders,
            'completed_percentage' => $completionRate,
            'total_earnings' => $totalPendapatan
        ]);
    }
}
