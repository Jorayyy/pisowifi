@extends('layouts.app')

@section('content')
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Total Devices</h3>
                <p class="text-3xl font-bold mt-2 text-gray-800">{{ $stats['total_devices'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-green-500">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Online Now</h3>
                <p class="text-3xl font-bold mt-2 text-green-600">{{ $stats['online_devices'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-purple-500">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Active Sessions</h3>
                <p class="text-3xl font-bold mt-2 text-purple-600">{{ $stats['active_sessions'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-yellow-500">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Total Revenue</h3>
                <p class="text-3xl font-bold mt-2 text-gray-800">₱{{ number_format($stats['total_revenue'], 2) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Recent Vouchers</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-500 text-sm">
                            <th class="py-2">Code</th>
                            <th class="py-2">Type</th>
                            <th class="py-2">Value</th>
                            <th class="py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($recent_vouchers as $voucher)
                        <tr class="border-b">
                            <td class="py-2 font-mono">{{ $voucher->code }}</td>
                            <td class="py-2 capitalize">{{ $voucher->type }}</td>
                            <td class="py-2">{{ $voucher->value }}</td>
                            <td class="py-2 text-xs">
                                <span class="px-2 py-1 rounded-full {{ $voucher->is_used ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $voucher->is_used ? 'Used' : 'Available' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4 text-gray-700">Recent Sessions</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-500 text-sm">
                            <th class="py-2">Device</th>
                            <th class="py-2">MAC</th>
                            <th class="py-2">Started</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($recent_sessions as $session)
                        <tr class="border-b">
                            <td class="py-2">{{ $session->device->name ?? 'Unknown' }}</td>
                            <td class="py-2 font-mono text-sm">{{ $session->mac_address }}</td>
                            <td class="py-2 text-sm">{{ $session->started_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

