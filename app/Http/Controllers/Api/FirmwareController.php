<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FirmwareVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FirmwareController extends Controller
{
    public function checkUpdate(Request $request)
    {
        $current = $request->current_version;
        $latest = FirmwareVersion::where('is_stable', true)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latest && $latest->version !== $current) {
            return response()->json([
                'update_available' => true,
                'version' => $latest->version,
                'url' => Storage::url($latest->file_path),
                'checksum' => $latest->checksum,
                'changelog' => $latest->changelog,
            ]);
        }

        return response()->json(['update_available' => false]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'version' => 'required|unique:firmware_versions',
            'firmware' => 'required|file',
            'is_stable' => 'boolean',
        ]);

        $path = $request->file('firmware')->store('firmware');

        $firmware = FirmwareVersion::create([
            'version' => $request->version,
            'file_path' => $path,
            'checksum' => hash_file('sha256', $request->file('firmware')->getRealPath()),
            'changelog' => $request->changelog,
            'is_stable' => $request->is_stable ?? false,
        ]);

        return response()->json($firmware, 201);
    }
}
