<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Setoran;

class DashboardController extends Controller
{
    public function index()
    {
        $earningsmonthly  = Setoran::earningsMonthly();
        $earningsadmin  = Setoran::earningsAdmin();
        $pendingrequests = Orders::PendingRequests();
        $persentaseSelesai = Orders::persentaseSelesai();
        $chartPerbulan = Setoran::getSetoranPerBulan();
        
        return view('admin.pages.home', [
            'title'             => 'Dashboard',
            'EarningsMonthly'   => $earningsmonthly,
            'EarningsAdmin'     => $earningsadmin,
            'PendingRequests'   => $pendingrequests,
            'PersentaseSelesai' => $persentaseSelesai,
            'ChartPerbulan'     => $chartPerbulan
        ]);
    }
}
