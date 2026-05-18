<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FranchiseController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Franchise::where('owner_id', $request->user()->id)->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $franchise = Franchise::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'owner_id' => $request->user()->id,
        ]);

        return response()->json($franchise, 201);
    }

    public function show(Franchise $franchise)
    {
        $this->authorize('view', $franchise);
        return response()->json($franchise->load('devices'));
    }
}
