@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Add New Branch Form -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-black text-gray-400 uppercase mb-4 italic">Register New Branch</h3>
        <form action="{{ route('franchises.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Branch Name (or Owner)</label>
                <input type="text" name="name" placeholder="e.g. SM North EDSA Branch" required class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Location Details</label>
                <input type="text" name="location" placeholder="Floor, Area, or City" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 uppercase italic text-sm">
                Add Branch
            </button>
        </form>
    </div>

    <!-- Branches List -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-sm font-black text-gray-400 uppercase italic">Your Branches / Franchises</h3>
            @if(session('success'))
                <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold">{{ session('success') }}</span>
            @endif
            @if(session('error'))
                <span class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full font-bold">{{ session('error') }}</span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($franchises as $franchise)
            <div class="p-4 rounded-xl border border-gray-50 bg-gray-50/50 hover:border-blue-200 transition-all group">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-bold text-gray-800">{{ $franchise->name }}</h4>
                        <p class="text-xs text-gray-500">{{ $franchise->location ?? 'No location set' }}</p>
                    </div>
                    <form action="{{ route('franchises.destroy', $franchise) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Remove this branch?')" class="text-red-400 hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                
                <div class="mt-4 flex gap-4">
                    <div class="text-center">
                        <span class="block text-lg font-black text-blue-600">{{ $franchise->devices_count }}</span>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Machine(s)</span>
                    </div>
                    <div class="text-center">
                        <span class="block text-lg font-black text-purple-600">{{ $franchise->vouchers_count }}</span>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Vouchers</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
