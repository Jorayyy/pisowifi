<?php

namespace App\Services\Voucher;

use App\Models\Voucher;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VoucherService
{
    /**
     * Activate a voucher for a specific device.
     */
    public function activate(string $code, string $deviceId)
    {
        return DB::transaction(function () use ($code, $deviceId) {
            $voucher = Voucher::where('code', $code)
                ->where('is_used', false)
                ->lockForUpdate()
                ->first();

            if (!$voucher) {
                throw new \Exception("Invalid or already used voucher code.");
            }

            $device = Device::findOrFail($deviceId);

            $voucher->update([
                'is_used' => true,
                'used_at' => now(),
                'device_id' => $device->id,
                'expires_at' => $this->calculateExpiry($voucher->type, $voucher->value)
            ]);

            return $voucher;
        });
    }

    private function calculateExpiry($type, $value)
    {
        if ($type === 'time') {
            return now()->addMinutes($value);
        }
        
        // Data-based vouchers might expire after a fixed duration (e.g. 30 days)
        return now()->addDays(30);
    }
}
