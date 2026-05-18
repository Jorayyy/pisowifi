<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceWebController extends Controller
{
    public function index()
    {
        $devices = Device::withCount('sessions')->get();
        return view('devices.index', compact('devices'));
    }
}
