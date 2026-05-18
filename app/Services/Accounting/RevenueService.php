<?php

namespace App\Services\Accounting;

use App\Models\Payment;
use App\Models\Franchise;
use Illuminate\Support\Facades\DB;

class RevenueService
{
    /**
     * Get revenue summary for a franchise.
     */
    public function getFranchiseSummary(string $franchiseId, $days = 30)
    {
        return Payment::where('franchise_id', $franchiseId)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays($days))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total_revenue'),
                DB::raw('COUNT(id) as transaction_count')
            )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }

    /**
     * Calculate Daily Earnings Per Machine.
     */
    public function getEarningsPerDevice(string $franchiseId)
    {
        return DB::table('payments')
            ->join('devices', 'payments.device_id', '=', 'devices.id')
            ->where('payments.franchise_id', $franchiseId)
            ->where('payments.status', 'completed')
            ->select(
                'devices.name as device_name',
                DB::raw('SUM(payments.amount) as total_earnings')
            )
            ->groupBy('devices.id', 'devices.name')
            ->get();
    }
}
