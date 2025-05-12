<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
            ->with(['orderDetails.service', 'customer', 'worker'])
            ->get();

        return view('admin.pages.setoran-create', [
            'title' => 'Tambah Setoran',
            'orders' => $orders
        ]);
    }

    // Menyimpan data setoran baru
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        DB::beginTransaction();
        try {
            $order = Orders::with(['orderDetails', 'worker'])->findOrFail($request->order_id);
            $total = $order->orderDetails->sum('subtotal');

            $jumlahAdmin = intval($total * 0.8);
            $jumlahPekerja = $total - $jumlahAdmin;

            $workerId = $order->worker_id;

            Setoran::create([
                'order_id' => $order->id,
                'worker_id' => $workerId,
                'jumlah_setoran' => $total,
                'jumlah_admin' => $jumlahAdmin,
                'jumlah_pekerja' => $jumlahPekerja,
                'tanggal_setoran' => now(),
                'status_setoran' => 'selesai', // ✅ SUDAH SESUAI ENUM
            ]);

            $order->update([
                'status' => 'selesai', // asumsinya order selesai saat setoran dibuat
                'total_pembayaran' => $total,
                'kembalian' => 0,
            ]);

            DB::commit();

            return redirect()->route('admin.setoran.index')->with('success', 'Setoran berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyimpan setoran: ' . $e->getMessage());
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
    public function laporanGaji(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $query = Setoran::select(
            'worker_id',
            DB::raw('SUM(jumlah_pekerja) as total_gaji'),
            DB::raw('COUNT(*) as jumlah_setoran'),
            DB::raw('MAX(tanggal_setoran) as terakhir_setor')
        )
        ->where('status_setoran', 'selesai')
        ->with('worker')
        ->groupBy('worker_id');

    if ($startDate && $endDate) {
        $query->whereBetween('tanggal_setoran', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ]);
    }

    $gajiPerPekerja = $query->get();

    return view('admin.pages.laporan-gaji', [
        'title' => 'Laporan Gaji Pekerja',
        'gajiPerPekerja' => $gajiPerPekerja,
        'startDate' => $startDate,
        'endDate' => $endDate
    ]);
}
public function laporanPendapatan(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $query = Setoran::select(
        DB::raw('SUM(jumlah_admin) as total_pendapatan'),
        DB::raw('COUNT(*) as total_transaksi'),
        DB::raw('MAX(tanggal_setoran) as terakhir_setoran')
    )->where('status_setoran', 'selesai');

    if ($startDate && $endDate) {
        $query->whereBetween('tanggal_setoran', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ]);
    }

    $pendapatan = $query->first();

    // Ambil semua data setorannya juga (untuk tabel detail)
    $setorans = Setoran::with(['order.customer', 'worker'])
        ->where('status_setoran', 'selesai');

    if ($startDate && $endDate) {
        $setorans->whereBetween('tanggal_setoran', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ]);
    }

    $setorans = $setorans->orderBy('tanggal_setoran', 'desc')->get();

    return view('admin.pages.laporan-pendapatan', [
        'title' => 'Laporan Pendapatan Admin',
        'pendapatan' => $pendapatan,
        'setorans' => $setorans,
        'startDate' => $startDate,
        'endDate' => $endDate
    ]);
}
}
