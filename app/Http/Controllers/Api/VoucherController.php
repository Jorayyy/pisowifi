<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function validateVoucher(Request $request)
    {
        $request->validate(['code' => 'required']);

        $voucher = Voucher::where('code', $request->code)->first();

        if (!$voucher) {
            return response()->json(['valid' => false, 'message' => 'Invalid voucher code'], 404);
        }

        if ($voucher->is_used) {
            return response()->json(['valid' => false, 'message' => 'Voucher already used'], 400);
        }

        if ($voucher->expires_at && $voucher->expires_at->isPast()) {
            return response()->json(['valid' => false, 'message' => 'Voucher expired'], 400);
        }

        return response()->json([
            'valid' => true,
            'voucher' => $voucher
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'franchise_id' => 'required|exists:franchises,id',
            'count' => 'required|integer|min:1|max:100',
            'type' => 'required|in:time,data,unlimited',
            'value' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $vouchers = [];
        for ($i = 0; $i < $request->count; $i++) {
            $vouchers[] = Voucher::create([
                'franchise_id' => $request->franchise_id,
                'code' => strtoupper(Str::random(8)),
                'type' => $request->type,
                'value' => $request->value,
                'price' => $request->price,
            ]);
        }

        return response()->json($vouchers, 201);
    }
}
