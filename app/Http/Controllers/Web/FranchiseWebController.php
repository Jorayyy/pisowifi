<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FranchiseWebController extends Controller
{
    public function index()
    {
        $franchises = Franchise::withCount(['devices', 'vouchers'])->latest()->get();
        return view('franchises.index', compact('franchises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:franchises,name',
            'location' => 'nullable|string|max:255',
        ]);

        Franchise::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'location' => $request->location,
            'owner_id' => auth()->id(),
        ]);

        return back()->with('success', 'Branch/Owner added successfully!');
    }

    public function destroy(Franchise $franchise)
    {
        if ($franchise->devices()->exists()) {
            return back()->with('error', 'Cannot delete branch with active devices.');
        }
        
        $franchise->delete();
        return back()->with('success', 'Branch removed successfully.');
    }
}
