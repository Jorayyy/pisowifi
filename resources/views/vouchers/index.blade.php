@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl">VOUCHER INVENTORY</h2>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-xs">GENERATE BATCH</button>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="border-b text-gray-500">
                <th class="py-3">CODE</th>
                <th class="py-3">TYPE</th>
                <th class="py-3">VALUE</th>
                <th class="py-3">PRICE</th>
                <th class="py-3">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-4 font-mono">{{ $voucher->code }}</td>
                <td class="py-4">{{ $voucher->type }}</td>
                <td class="py-4">{{ $voucher->value }}</td>
                <td class="py-4">₱{{ number_format($voucher->price, 2) }}</td>
                <td class="py-4">
                    <span class="px-2 py-1 rounded {{ $voucher->is_used ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                        {{ $voucher->is_used ? 'USED' : 'ACTIVE' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 font-normal">
        {{ $vouchers->links() }}
    </div>
</div>
@endsection
