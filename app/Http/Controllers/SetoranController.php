<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendapatanExport;
use Barryvdh\DomPDF\Facade\Pdf;




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

        return view('admin.pages.setoran', [
            'title' => 'Daftar Setoran',
            'setorans' => $setorans
        ]);
    }

    // Menampilkan form input setoran baru
    public function create()
    {
     $orders = Orders::where('status', 'pending_setoran')
    ->with(['customer', 'worker', 'orderDetails.service'])
    ->get();

        return view('admin.pages.setoran-create', [
            'title' => 'Tambah Setoran',
            'orders' => $orders
        ]);
    }

    // Menyimpan data setoran baru
    public function store(Request $request)
    {
        // Validasi dasar input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'jumlah_setoran' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $order = Orders::with(['orderDetails', 'worker'])->findOrFail($request->order_id);
            $total = $order->orderDetails->sum('subtotal');

            // Validasi: jumlah setoran tidak boleh kurang dari total tagihan
            if ($request->jumlah_setoran < $total) {
                DB::rollBack();
                $formattedTotal = number_format($total, 0, ',', '.');
                // Pastikan pesan error yang lebih spesifik
                return redirect()
                    ->back()
                    ->withInput($request->all())
                    ->withErrors(['jumlah_setoran' => "Jumlah setoran kurang dari total tagihan. Total tagihan order ini adalah Rp {$formattedTotal}. Harap isi setoran minimal sebesar itu."]);
            }

            $jumlahAdmin = intval($total * 0.2);
            $jumlahPekerja = $total - $jumlahAdmin;

            $workerId = $order->worker_id;

            Setoran::create([
                'order_id' => $order->id,
                'worker_id' => $workerId,
                'jumlah_setoran' => $request->jumlah_setoran,
                'jumlah_admin' => $jumlahAdmin,
                'jumlah_pekerja' => $jumlahPekerja,
                'tanggal_setoran' => now(),
                'status_setoran' => 'selesai',
            ]);

            $order->update([
                'status' => 'selesai',
                'total_pembayaran' => $total,
                'kembalian' => $request->jumlah_setoran - $total,
            ]);

            DB::commit();

            return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyimpan setoran: ' . $e->getMessage())->withInput();
        }
    }

    // Mengupdate data setoran
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_setoran' => 'required|integer|min:0'
        ]);

        $setoran = Setoran::with('order.orderDetails')->findOrFail($id);
        $total = $setoran->order->orderDetails->sum('subtotal');
        $kembalian = $request->jumlah_setoran - $total;

        $statusSetoran = $request->jumlah_setoran >= $total ? 'selesai' : 'kurang';
        $statusOrder = $request->jumlah_setoran >= $total ? 'selesai' : 'pending';

        $setoran->update([
            'jumlah_setoran' => $request->jumlah_setoran,
            'status_setoran' => $statusSetoran,
        ]);

        $setoran->order->update([
            'status' => $statusOrder,
            'total_pembayaran' => $total,
            'kembalian' => $kembalian > 0 ? $kembalian : 0,
        ]);

        return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil diperbarui.');
    }
    //laporan gaji didapat dari 80% dari total setoran

  //laporan pendapatan didapat dari 20% dari total setoran


    //unduh laporan
    
}
