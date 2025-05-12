<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $ordersQuery = Orders::with(['user', 'orderDetails.service'])
            ->select('orders.*')
            ->join('users', 'orders.user_id', '=', 'users.id');

        if ($request->has('date')) {
            $ordersQuery->whereDate('tanggal_pemesanan', $request->date);
        }

        if ($request->has('service_id')) {
            $serviceId = $request->service_id;
            $ordersQuery->whereHas('orderDetails', function ($query) use ($serviceId) {
                $query->where('service_id', $serviceId);
            });
        }

        if ($request->has('status')) {
            $ordersQuery->where('orders.status', $request->status);
        }

        $orders = $ordersQuery->orderBy('tanggal_pemesanan', 'desc')->paginate(10);
        $services = Service::all();
        $workers = User::where('role', 'worker')->get();

        return view('admin.pages.PesananMasuk', [
            'title' => 'Pesanan Masuk',
            'orders' => $orders,
            'services' => $services,
            'workers' => $workers
        ]);
    }

    public function show(Orders $order)
    {
        $order->load(['user', 'orderDetails.service']);
        return view('admin.pages.Detailpesanan', [
            'title' => 'Detail Pesanan',
            'order' => $order
        ]);
    }

    public function accept($id)
    {
        $order = Orders::findOrFail($id);

        if (!$order->worker_id) {
            return redirect()->back()->with('error', 'Pilih pekerja terlebih dahulu sebelum menerima pesanan.');
        }

        $order->status = 'proses';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan telah diterima.');
    }

    public function complete(Orders $order)
    {
        $order->status = 'selesai_pengerjaan';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditandai selesai pengerjaan');
    }

    public function readyForPayment(Orders $order)
    {
        $order->status = 'pending_setoran';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditandai siap dibayar');
    }

    public function reject(Orders $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditolak');
    }

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

    public function assignWorker(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'worker_id' => 'required|exists:users,id',
        ]);

        $order = Orders::findOrFail($request->order_id);
        $order->worker_id = $request->worker_id;
        $order->status = 'proses';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Tukang berhasil ditugaskan ke pesanan.');
    }
}
