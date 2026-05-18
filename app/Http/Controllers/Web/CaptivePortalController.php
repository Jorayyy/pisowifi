<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class CaptivePortalController extends Controller
{
    public function show(Request $request)
    {
        // In a real scenario, the device redirects the user to this URL 
        // with their MAC address and the Device's ID.
        $deviceId = $request->query('device_id');
        $macAddress = $request->query('mac');
        
        $device = Device::find($deviceId);

        return view('captive.index', [
            'device' => $device,
            'mac' => $macAddress
        ]);
    }
}
