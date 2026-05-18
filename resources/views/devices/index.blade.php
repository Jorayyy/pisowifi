@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl">REGISTERED DEVICES</h2>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-xs">ADD NEW DEVICE</button>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="border-b text-gray-500">
                <th class="py-3">NAME</th>
                <th class="py-3">SERIAL</th>
                <th class="py-3">STATUS</th>
                <th class="py-3">LAST HEARTBEAT</th>
                <th class="py-3">USERS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-4">{{ $device->name }}</td>
                <td class="py-4 font-mono">{{ $device->serial_number }}</td>
                <td class="py-4">
                    <span class="px-2 py-1 rounded {{ $device->status == 'online' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $device->status }}
                    </span>
                </td>
                <td class="py-4 text-gray-500 font-normal capitalize">
                    {{ $device->last_heartbeat ? $device->last_heartbeat->diffForHumans() : 'Never' }}
                </td>
                <td class="py-4">{{ $device->sessions_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
