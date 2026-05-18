<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Voucher;
use App\Models\Session;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_devices' => Device::count(),
            'online_devices' => Device::where('status', 'online')->count(),
            'active_sessions' => Session::where('status', 'active')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
        ];

        $recent_vouchers = Voucher::latest()->take(5)->get();
        $recent_sessions = Session::with('device')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recent_vouchers', 'recent_sessions'));
    }
}
