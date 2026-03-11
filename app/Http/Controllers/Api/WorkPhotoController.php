<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkPhoto;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class WorkPhotoController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan user sudah login
        $workerId = Auth::id();
        if (!$workerId) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'photo_before' => 'nullable|image|max:2048',
            'photo_after' => 'nullable|image|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Pastikan order itu milik pekerja yang login
        $order = Orders::where('id', $request->order_id)
                       ->where('worker_id', $workerId)
                       ->first();

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan atau bukan milik Anda.'], 403);
        }

        $photoBefore = $request->file('photo_before')?->store('work_photos/before', 'public');
        $photoAfter  = $request->file('photo_after')?->store('work_photos/after', 'public');

        $workPhoto = WorkPhoto::updateOrCreate(
            ['order_id' => $request->order_id],
            [
                'worker_id' => $workerId,
                'photo_before' => $photoBefore,
                'photo_after' => $photoAfter,
                'catatan' => $request->catatan,
            ]
        );

        // Jika kedua foto sudah ada, ubah status order
        if ($workPhoto->photo_before && $workPhoto->photo_after) {
            $order->status = 'selesai_pengerjaan';
            $order->save();
        }

        return response()->json([
            'message' => 'Berhasil upload foto kerja',
            'data' => $workPhoto
        ]);
    }
}
