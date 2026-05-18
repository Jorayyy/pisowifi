<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoucherWebController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::with('franchise')->latest()->paginate(10);
        $franchises = Franchise::all();
        return view('vouchers.index', compact('vouchers', 'franchises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'franchise_id' => 'required|exists:franchises,id',
            'count' => 'required|integer|min:1|max:100',
            'type' => 'required|in:time,data,unlimited',
            'value' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        for ($i = 0; $i < $request->count; $i++) {
            Voucher::create([
                'franchise_id' => $request->franchise_id,
                'code' => strtoupper(Str::random(8)),
                'type' => $request->type,
                'value' => $request->value,
                'price' => $request->price,
            ]);
        }

        return back()->with('success', "{$request->count} vouchers generated successfully!");
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return back()->with('success', 'Voucher deleted successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:vouchers,id',
        ]);

        Voucher::whereIn('id', $request->ids)->delete();

        return back()->with('success', count($request->ids) . ' vouchers deleted successfully!');
    }
}
