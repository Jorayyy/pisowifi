<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function heartbeat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mac_address' => 'required',
            'metrics' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $device = Device::where('mac_address', $request->mac_address)->first();

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        $device->update([
            'last_heartbeat' => now(),
            'status' => 'online',
            'ip_address' => $request->ip(),
            'firmware_version' => $request->firmware_version ?? $device->firmware_version,
        ]);

        $device->metrics()->create([
            'cpu_usage' => $request->metrics['cpu'] ?? 0,
            'ram_usage' => $request->metrics['ram'] ?? 0,
            'temperature' => $request->metrics['temp'] ?? 0,
            'connected_users' => $request->metrics['users'] ?? 0,
            'uptime' => $request->metrics['uptime'] ?? 0,
        ]);

        return response()->json([
            'status' => 'success',
            'config' => $device->config,
            'server_time' => now()->toIso8601String(),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|unique:devices',
            'mac_address' => 'required|unique:devices',
            'franchise_id' => 'required|exists:franchises,id',
        ]);

        $device = Device::create([
            'serial_number' => $request->serial_number,
            'mac_address' => $request->mac_address,
            'franchise_id' => $request->franchise_id,
            'status' => 'offline',
        ]);

        return response()->json($device, 201);
    }
}
