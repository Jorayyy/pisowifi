<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceWebController extends Controller
{
    public function index()
    {
        $devices = Device::with('franchise')->withCount('sessions')->latest()->get();
        $franchises = Franchise::all();
        return view('devices.index', compact('devices', 'franchises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:devices,serial_number',
            'franchise_id' => 'required|exists:franchises,id',
        ]);

        Device::create([
            'name' => $request->name,
            'serial_number' => strtoupper($request->serial_number),
            'franchise_id' => $request->franchise_id,
            'status' => 'offline',
        ]);

        return back()->with('success', 'Device registered successfully!');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return back()->with('success', 'Device removed successfully.');
    }
}
