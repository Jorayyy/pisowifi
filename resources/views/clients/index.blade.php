@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-sm font-black text-gray-400 uppercase italic">Active WiFi Clients</h3>
            <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Real-time monitoring of connected users</p>
        </div>
        @if(session('success'))
            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold">{{ session('success') }}</span>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b">
                    <th class="pb-3 text-left">CLIENT MAC</th>
                    <th class="pb-3 text-left">CONNECTED TO</th>
                    <th class="pb-3 text-left">PLAN / VOUCHER</th>
                    <th class="pb-3 text-center">TIME LEFT</th>
                    <th class="pb-3 text-right">ACTION</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($activeClients as $session)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <td class="py-4">
                        <div class="font-mono font-bold text-blue-600">{{ $session->mac_address }}</div>
                        <div class="text-[10px] text-gray-400 uppercase font-black">Local IP: {{ $session->ip_address ?? 'Auto' }}</div>
                    </td>
                    <td class="py-4">
                        <div class="font-bold text-gray-700">{{ $session->device->name }}</div>
                        <div class="text-[10px] text-gray-400 font-mono">{{ $session->device->serial_number }}</div>
                    </td>
                    <td class="py-4">
                        @if($session->voucher)
                            <span class="bg-purple-50 text-purple-600 px-2 py-1 rounded text-[10px] font-black uppercase">
                                Voucher: {{ $session->voucher->code }}
                            </span>
                        @else
                            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-[10px] font-black uppercase">
                                Coin Drop
                            </span>
                        @endif
                    </td>
                    <td class="py-4 text-center">
                        <span class="font-black text-red-500">
                            {{ now()->diffInMinutes($session->expires_at) }} mins
                        </span>
                        <div class="text-[10px] text-gray-400 uppercase font-bold">Expires {{ $session->expires_at->format('H:i') }}</div>
                    </td>
                    <td class="py-4 text-right">
                        <form action="{{ route('clients.kick', $session) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Force disconnect this user?')" class="text-red-400 hover:text-red-600 p-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center">
                        <div class="text-gray-300">
                            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="text-sm font-bold uppercase italic">No users currently connected</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $activeClients->links() }}
    </div>
</div>
@endsection
