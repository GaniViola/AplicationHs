<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class StatusPekerjaanController extends Controller
{
    public function index(Request $request)
    {
       $workerId = Auth::id();

        $stats = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->where('worker_id', $workerId)
            ->whereIn('status', ['proses', 'selesai_pengerjaan', 'selesai'])
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json([
            'proses' => $stats['proses'] ?? 0,
            'selesai_pengerjaan' => $stats['selesai_pengerjaan'] ?? 0,
            'selesai' => $stats['selesai'] ?? 0,
        ]);
    }
}
