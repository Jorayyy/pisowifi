@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Registration Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-6">
            <h3 class="text-sm font-black text-gray-400 uppercase mb-4 italic">Register Branch Machine</h3>
            <form action="{{ route('devices.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Device Name</label>
                    <input type="text" name="name" placeholder="e.g. Kiosk #1" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Serial Number</label>
                    <input type="text" name="serial_number" placeholder="PISO-XXXX" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm font-mono focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Assign to Franchise</label>
                    <select name="franchise_id" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                        @foreach($franchises as $franchise)
                            <option value="{{ $franchise->id }}">{{ $franchise->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 uppercase italic text-sm">
                    Register Machine
                </button>
            </form>
        </div>
    </div>

    <!-- Branch Machine List -->
    <div class="lg:col-span-3">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-sm font-black text-gray-400 uppercase italic">Branch Management</h3>
                @if(session('success'))
                    <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold">{{ session('success') }}</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b">
                            <th class="pb-3 text-left">BRANCH NAME & SERIAL</th>
                            <th class="pb-3 text-left">FRANCHISE</th>
                            <th class="pb-3 text-center">STATUS</th>
                            <th class="pb-3 text-right">LAST PING</th>
                            <th class="pb-3 text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($devices as $device)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="py-4">
                                <div class="font-bold text-gray-800">{{ $device->name }}</div>
                                <div class="text-[10px] font-mono text-gray-400">{{ $device->serial_number }}</div>
                            </td>
                            <td class="py-4 text-xs font-bold text-gray-600">
                                {{ $device->franchise->name }}
                            </td>
                            <td class="py-4 text-center">
                                @if($device->status === 'online')
                                    <span class="inline-flex items-center px-2 py-1 bg-green-50 text-green-600 text-[10px] font-black rounded-md">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                        ONLINE
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-gray-50 text-gray-400 text-[10px] font-black rounded-md">
                                        OFFLINE
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 text-right text-[10px] text-gray-500 font-bold uppercase">
                                {{ $device->last_heartbeat ? $device->last_heartbeat->diffForHumans() : 'Never Connected' }}
                            </td>
                            <td class="py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <form action="{{ route('devices.destroy', $device) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Remove this device from fleet?')" class="p-2 text-gray-300 hover:text-red-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
