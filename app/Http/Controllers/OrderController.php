<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Query builder for orders
        $ordersQuery = Orders::with(['user', 'orderDetails.service'])
            ->select('orders.*')
            ->join('users', 'orders.user_id', '=', 'users.id');

        // Apply filters if present
        if ($request->has('date')) {
            $date = $request->date;
            $ordersQuery->whereDate('tanggal_pemesanan', $date);
        }

        if ($request->has('service_id')) {
            $serviceId = $request->service_id;
            $ordersQuery->whereHas('orderDetails', function ($query) use ($serviceId) {
                $query->where('service_id', $serviceId);
            });
        }

        if ($request->has('status')) {
            $status = $request->status;
            $ordersQuery->where('orders.status', $status);
        }

        // Get paginated orders
        $orders = $ordersQuery->orderBy('tanggal_pemesanan', 'desc')->paginate(10);

        // Get all services for filter dropdown
        $services = Service::all();

        return view('admin.pages.PesananMasuk', compact('orders', 'services'));
    }

    /**
     * Show order details
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $order)
    {
        $order->load(['user', 'orderDetails.service']);
        return view('admin.pages.Detailpesanan', compact('order'));
    }

    /**
     * Update order status to proses (accepted)
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
   /**
 * Update order status to proses (accepted)
 */
public function accept(Orders $order)
{
    $order->status = 'proses';
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diterima dan diproses');
}

/**
 * Mark order as finished (selesai_pengerjaan)
 */
public function complete(Orders $order)
{
    $order->status = 'selesai_pengerjaan';
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditandai selesai pengerjaan');
}

/**
 * Mark order as ready for payment (pending_setoran)
 */
public function readyForPayment(Orders $order)
{
    $order->status = 'pending_setoran';
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditandai siap dibayar');
}

/**
 * Cancel/reject an order
 */
public function reject(Orders $order)
{
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditolak');
}

    /**
     * Get order details as JSON for AJAX requests
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetails(Orders $order)
    {
        $order->load(['user', 'orderDetails.service']);
        
        return response()->json([
            'order' => $order,
            'customer' => $order->user,
            'details' => $order->orderDetails,
            'total' => $order->orderDetails->sum('subtotal')
        ]);
    }
}