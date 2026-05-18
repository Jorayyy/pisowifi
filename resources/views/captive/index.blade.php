<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piso WiFi Captive Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-blue-600 p-8 text-center text-white">
            <h1 class="text-2xl font-black uppercase italic">Piso WiFi</h1>
            <p class="text-blue-200 text-sm mt-1">Connect to High-Speed Internet</p>
        </div>
        
        <div class="p-8 box-border">
            <div class="mb-6 text-center">
                <p class="text-gray-500 text-xs uppercase font-bold">Active Device</p>
                <p class="text-gray-800 font-semibold">{{ $device->name ?? 'Hotspot Node' }}</p>
            </div>

            <!-- Tabs -->
            <div class="flex mb-6 bg-gray-100 p-1 rounded-xl" x-data="{ tab: 'insert' }">
                <button 
                    @click="tab = 'insert'" 
                    :class="tab === 'insert' ? 'bg-white shadow text-blue-600' : 'text-gray-500'"
                    class="flex-1 py-2 text-xs font-black uppercase rounded-lg transition-all">
                    Insert Coin
                </button>
                <button 
                    @click="tab = 'voucher'" 
                    :class="tab === 'voucher' ? 'bg-white shadow text-blue-600' : 'text-gray-500'"
                    class="flex-1 py-2 text-xs font-black uppercase rounded-lg transition-all">
                    Voucher
                </button>
            </div>

            <div x-data="{ 
                tab: 'insert',
                isInserting: false,
                coins: 0,
                startInserting() {
                    this.isInserting = true;
                    // In a real scenario, this would call an API to tell the Mini PC to start the coin slot
                    console.log('Activating coin slot for device...');
                }
            }">
                <!-- Insert Coin Mode -->
                <div x-show="tab === 'insert'" class="space-y-4 animate-in fade-in duration-300">
                    <template x-if="!isInserting">
                        <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center">
                            <div class="mb-4">
                                <svg class="w-12 h-12 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest">Ready to Pay?</h3>
                            <p class="text-[10px] text-gray-400 mt-1">Press the button below to start inserting coins into this machine.</p>
                            
                            <button @click="startInserting()" class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition-transform active:scale-95 uppercase italic text-sm">
                                INSERT COIN
                            </button>
                        </div>
                    </template>

                    <template x-if="isInserting">
                        <div class="bg-blue-50 border-2 border-blue-100 rounded-2xl p-6 text-center animate-pulse">
                            <div class="inline-block p-3 bg-blue-600 rounded-full mb-3 shadow-lg shadow-blue-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-black text-blue-900 uppercase italic">INSERTING COINS...</h3>
                            <p class="text-blue-600 text-[10px] font-bold uppercase tracking-widest mt-1">Machine is now active</p>
                            
                            <div class="mt-4 flex items-center justify-center space-x-2">
                                <span class="text-4xl font-black text-blue-600" x-text="'₱' + coins.toFixed(2)">₱0.00</span>
                            </div>

                            <button @click="isInserting = false" class="mt-4 text-[10px] font-bold text-red-500 uppercase hover:underline">Cancel session</button>
                        </div>
                    </template>

                    <button :disabled="!isInserting || coins <= 0" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition-transform active:scale-95 disabled:opacity-30 disabled:grayscale">
                        CONNECT NOW
                    </button>
                </div>

                <!-- Voucher Mode -->
                <div x-show="tab === 'voucher'" style="display: none;" class="space-y-4 animate-in fade-in duration-300">
                    <div class="border-2 border-gray-100 rounded-xl p-4">
                        <label class="block text-gray-400 text-[10px] font-bold uppercase mb-1">Voucher Code</label>
                        <input type="text" placeholder="ENTER CODE HERE" class="w-full text-xl font-bold tracking-widest uppercase focus:outline-none text-blue-600 placeholder-gray-300">
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition-transform active:scale-95">
                        CONNECT NOW
                    </button>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold">Your MAC</p>
                    <p class="text-gray-600 text-xs font-mono">{{ $mac ?? '00:00:00:00:00:00' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-400 text-[10px] uppercase font-bold">Options</p>
                    <button class="text-blue-600 text-xs font-bold hover:underline">Buy Voucher</button>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-4 text-center">
            <p class="text-gray-400 text-[10px] uppercase font-medium">Powered by Piso WiFi Cloud</p>
        </div>
    </div>
</body>
</html>
