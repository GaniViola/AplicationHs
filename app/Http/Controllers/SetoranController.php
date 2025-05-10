<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class SetoranController extends Controller
{
    // Menampilkan halaman daftar setoran
    public function index()
    {
        $setorans = Setoran::with([
            'order.customer',
            'order.orderDetails.service',
            'worker'
        ])->orderBy('tanggal_setoran', 'desc')->get();

        return view('admin.pages.setoran', compact('setorans'));
    }

    // Menampilkan form untuk input setoran baru
   // Menampilkan form untuk input setoran baru
   public function create()
   {
       // Ambil orders berstatus pending, include relasi penting
       $orders = Orders::where('status', 'pending_setoran')
           ->with(['orderDetails.service', 'customer', 'worker']) // Memuat relasi customer dan worker
           ->get();
   
       return view('admin.pages.setoran-create', compact('orders'));
   }
   
   


    // Menyimpan setoran baru
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'jumlah_setoran' => 'required|integer|min:0'
        ]);
    
        DB::beginTransaction();
        try {
            $order = Orders::with(['orderDetails', 'worker'])->findOrFail($request->order_id);
            $total = $order->orderDetails->sum('subtotal');
            $kembalian = $request->jumlah_setoran - $total;
    
            // Ambil worker_id dari relasi order
            $workerId = $order->worker_id; // pastikan orders punya kolom ini
    
            Setoran::create([
                'order_id' => $order->id,
                'worker_id' => $workerId,
                'jumlah_setoran' => $request->jumlah_setoran,
                'tanggal_setoran' => now(),
                'status_setoran' => 'pending-setoran', // default status
            ]);
    
            // Ubah status order jika sudah lunas
            if ($request->jumlah_setoran >= $total) {
                $order->update([
                    'status' => 'selesai',
                    'total_pembayaran' => $total,
                    'kembalian' => $kembalian > 0 ? $kembalian : 0,
                ]);
            }
    
            DB::commit();
    
            return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil disimpan.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyimpan setoran: ' . $e->getMessage());
        }
    }
    
    // Proses update data setoran
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_setoran' => 'required|integer|min:0'
        ]);

        $setoran = Setoran::with('order.orderDetails')->findOrFail($id);
        $total = $setoran->order->orderDetails->sum('subtotal');
        $kembalian = $request->jumlah_setoran - $total;

        $setoran->update([
            'jumlah_setoran' => $request->jumlah_setoran,
            'status_setoran' => $request->jumlah_setoran >= $total ? 'selesai' : 'kurang',
        ]);

        $setoran->order->update([
            'status' => $request->jumlah_setoran >= $total ? 'selesai' : 'pending',
            'total_pembayaran' => $total,
            'kembalian' => $kembalian > 0 ? $kembalian : 0,
        ]);

        return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil diperbarui.');
    }
}
