<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'services' => 'required|array',
            'services.*.service_id' => 'required|integer',
            'services.*.quantity' => 'required|integer',
            'services.*.price' => 'required|integer',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Simpan data order
            $order = Orders::create([
                'user_id' => $request->user_id,
                'tanggal_pemesanan' => $request->tanggal_pemesanan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'pending', // status default
            ]);

            // Cek jika ID order masih null
            if ($order->id === null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan order, ID order tidak ditemukan.',
                ], 500);
            }

            // Simpan data order detail
            foreach ($request->services as $service) {
                OrderDetails::create([
                    'id_orders' => $order->id,
                    'service_id' => $service['service_id'],
                    'quantity' => $service['quantity'],
                    'price' => $service['price'],
                    'subtotal' => $service['quantity'] * $service['price'],
                ]);
            }

            // Commit transaksi jika tidak ada error
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Order berhasil dibuat',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Gagal membuat order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mengambil riwayat pesanan user
    public function history(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $orders = Orders::where('user_id', $request->user_id)
                    ->with('orderDetails.service') // relasi ke detail dan service
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data riwayat berhasil diambil',
            'data' => $orders
        ]);
    }
    public function getUserOrders($userId)
{
    $orders = Orders::with('orderDetails.service') // Eager load relasi
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Riwayat pesanan ditemukan',
        'data' => $orders
    ]);
}


}
