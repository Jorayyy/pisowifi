<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Voucher;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function authorize(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'voucher_code' => 'required',
            'mac_address' => 'required',
        ]);

        $voucher = Voucher::where('code', $request->voucher_code)
            ->where('is_used', false)
            ->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Invalid or used voucher'], 400);
        }

        $session = Session::create([
            'device_id' => $request->device_id,
            'voucher_id' => $voucher->id,
            'mac_address' => $request->mac_address,
            'started_at' => now(),
            'ends_at' => $voucher->type === 'time' ? now()->addMinutes($voucher->value) : null,
            'data_limit' => $voucher->type === 'data' ? $voucher->value : null,
            'status' => 'active',
        ]);

        $voucher->update([
            'is_used' => true,
            'used_at' => now(),
            'device_id' => $request->device_id,
        ]);

        return response()->json([
            'success' => true,
            'session' => $session
        ]);
    }
}
