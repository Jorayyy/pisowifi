<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function gcashWebhook(Request $request)
    {
        // Simple mock of GCash webhook logic
        $request->validate([
            'reference' => 'required',
            'amount' => 'required|numeric',
            'device_id' => 'required|exists:devices,id',
        ]);

        $payment = Payment::create([
            'franchise_id' => $request->franchise_id, // Should be fetched from device context
            'device_id' => $request->device_id,
            'reference_number' => $request->reference,
            'amount' => $request->amount,
            'method' => 'GCash',
            'status' => 'completed',
            'gateway_response' => $request->all(),
        ]);

        // Logic here to trigger session activation or voucher generation
        
        return response()->json(['success' => true]);
    }
}
