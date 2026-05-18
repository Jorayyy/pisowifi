@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Generate Vouchers Form -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-black text-gray-400 uppercase mb-4 italic">Generate Vouchers</h3>
        <form action="{{ route('vouchers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Franchise (Owner)</label>
                <select name="franchise_id" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                    @foreach($franchises as $franchise)
                        <option value="{{ $franchise->id }}">{{ $franchise->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Type</label>
                    <select name="type" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="time">Time (Mins)</option>
                        <option value="data">Data (MB)</option>
                        <option value="unlimited">Unlimited</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Quantity</label>
                    <input type="number" name="count" value="10" min="1" max="100" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Value</label>
                    <input type="number" name="value" placeholder="e.g. 60" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Price (₱)</label>
                    <input type="number" step="0.01" name="price" placeholder="5.00" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 uppercase italic text-sm">
                Generate Vouchers
            </button>
        </form>
    </div>

    <!-- Voucher Inventory Table -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('vouchers.bulk_destroy') }}" method="POST" x-data="{ selected: [] }">
            @csrf
            @method('DELETE')
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h3 class="text-sm font-black text-gray-400 uppercase italic">Voucher Inventory</h3>
                    <button type="submit" 
                            x-show="selected.length > 0" 
                            class="bg-red-500 hover:bg-red-600 text-white text-[10px] font-black px-3 py-1.5 rounded-lg flex items-center gap-2 transition-all"
                            onclick="return confirm('Delete selected vouchers?')">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        DELETE SELECTED (<span x-text="selected.length"></span>)
                    </button>
                </div>
                @if(session('success'))
                    <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold animate-bounce">{{ session('success') }}</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b">
                            <th class="pb-3 w-8">
                                <input type="checkbox" @change="$el.checked ? selected = [{{ $vouchers->pluck('id')->implode(',') }}] : selected = []" class="rounded border-gray-300">
                            </th>
                            <th class="pb-3">CODE</th>
                            <th class="pb-3">FRANCHISE</th>
                            <th class="pb-3">LIMIT</th>
                            <th class="pb-3">PRICE</th>
                            <th class="pb-3">STATUS</th>
                            <th class="pb-3 text-right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($vouchers as $voucher)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <td class="py-4">
                                <input type="checkbox" name="ids[]" value="{{ $voucher->id }}" x-model="selected" class="rounded border-gray-300">
                            </td>
                            <td class="py-4 font-mono font-bold text-blue-600">{{ $voucher->code }}</td>
                            <td class="py-4 text-xs font-bold text-gray-600">{{ $voucher->franchise->name }}</td>
                            <td class="py-4 text-xs">
                                <span class="uppercase">{{ $voucher->value }} {{ $voucher->type }}</span>
                            </td>
                            <td class="py-4 font-bold">₱{{ number_format($voucher->price, 2) }}</td>
                            <td class="py-4 border-gray-50 uppercase">
                                @if($voucher->is_used)
                                    <span class="bg-red-50 text-red-500 text-[10px] font-black px-2 py-1 rounded-md">USED</span>
                                @else
                                    <span class="bg-green-50 text-green-500 text-[10px] font-black px-2 py-1 rounded-md">ACTIVE</span>
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                <button type="button" @click="selected.includes({{ $voucher->id }}) ? selected = selected.filter(i => i !== {{ $voucher->id }}) : selected.push({{ $voucher->id }})" 
                                        :class="selected.includes({{ $voucher->id }}) ? 'text-blue-600 bg-blue-50' : 'text-gray-300'"
                                        class="p-2 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<div class="mt-6 uppercase text-[10px] font-bold">
    {{ $vouchers->links() }}
</div>
@endsection
