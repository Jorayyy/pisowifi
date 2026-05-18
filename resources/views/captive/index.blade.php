<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect - ABELLA'S PISO WIFI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .glow { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
    </style>
</head>
<body class="bg-[#0f172a] flex items-center justify-center min-h-screen p-4 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-indigo-600/10 rounded-full blur-3xl animate-pulse delay-700"></div>
    </div>

    <div class="glass-card w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20 z-10 transition-all">
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-10 text-center text-white relative">
            <div class="absolute top-4 right-4 animate-spin-slow">
                <svg class="w-12 h-12 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z"></path></svg>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight">ABELLA'S</h1>
            <p class="text-blue-100/80 text-xs font-bold uppercase tracking-[0.3em] mt-1">Free WiFi Access</p>
        </div>
        
        <div class="p-10 box-border">
            <div class="mb-8 text-center flex items-center justify-center space-x-3 bg-slate-50 py-3 rounded-2xl border border-slate-100">
                <div class="w-2 h-2 bg-green-500 rounded-full glow animate-ping"></div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-none mb-1">Active Machine</p>
                    <p class="text-slate-800 font-bold text-xs uppercase">{{ $device->name ?? 'Hotspot Node' }}</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex mb-8 bg-slate-100 p-1.5 rounded-2xl" x-data="{ tab: 'insert' }">
                <button 
                    @click="tab = 'insert'" 
                    :class="tab === 'insert' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-500'"
                    class="flex-1 py-3 text-[10px] font-extrabold uppercase tracking-widest rounded-xl transition-all">
                    Insert Coin
                </button>
                <button 
                    @click="tab = 'voucher'" 
                    :class="tab === 'voucher' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-500'"
                    class="flex-1 py-3 text-[10px] font-extrabold uppercase tracking-widest rounded-xl transition-all">
                    Use Voucher
                </button>
            </div>

            <div x-data="{ 
                tab: 'insert',
                isInserting: false,
                coins: 0,
                startInserting() {
                    this.isInserting = true;
                }
            }">
                <!-- Insert Coin Mode -->
                <div x-show="tab === 'insert'" class="space-y-6">
                    <template x-if="!isInserting">
                        <div class="bg-slate-50/50 border-2 border-dashed border-slate-200 rounded-[2rem] p-10 text-center transition-all hover:bg-slate-50">
                            <div class="w-16 h-16 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center mx-auto mb-6 transform transition-transform hover:scale-110">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-xs font-extrabold text-slate-800 uppercase tracking-widest">Connect with Coins</h3>
                            <p class="text-[10px] text-slate-400 font-medium mt-2 leading-relaxed px-4">Tap the button below then drop coins into the machine.</p>
                            
                            <button @click="startInserting()" class="mt-8 w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-5 rounded-[1.25rem] shadow-xl shadow-blue-500/30 transition-all active:scale-95 uppercase tracking-widest text-xs">
                                START SESSION
                            </button>
                        </div>
                    </template>

                    <template x-if="isInserting">
                        <div class="bg-blue-50 border border-blue-100 rounded-[2rem] p-10 text-center animate-in zoom-in duration-300">
                            <div class="inline-block p-4 bg-blue-600 rounded-3xl mb-6 shadow-xl shadow-blue-500/40 animate-bounce">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-xs font-extrabold text-blue-900 uppercase tracking-widest">LISTENING FOR COINS</h3>
                            <p class="text-blue-500 text-[9px] font-black uppercase tracking-[0.2em] mt-3 animate-pulse">Waiting for drop...</p>
                            
                            <div class="my-8">
                                <span class="text-5xl font-extrabold text-slate-900 tracking-tighter" x-text="'₱' + coins.toFixed(0)">₱0</span>
                                <span class="block text-[10px] text-slate-400 font-bold uppercase mt-2">Total Amount Inserted</span>
                            </div>

                            <button @click="isInserting = false" class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:text-red-700 transition-colors">Cancel Payment</button>
                        </div>
                    </template>

                    <button :disabled="!isInserting || coins <= 0" class="w-full bg-slate-900 hover:bg-black text-white font-extrabold py-5 rounded-[1.25rem] shadow-2xl transition-all active:scale-95 disabled:opacity-10 uppercase tracking-widest text-xs">
                        ACTIVATE INTERNET
                    </button>
                </div>

                <!-- Voucher Mode -->
                <div x-show="tab === 'voucher'" style="display: none;" class="space-y-6">
                    <div class="bg-slate-50 border border-slate-200 rounded-[1.25rem] p-6 focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-500 transition-all">
                        <label class="block text-slate-400 text-[9px] font-black uppercase tracking-[0.2em] mb-3">Voucher Code</label>
                        <input type="text" placeholder="XXXX - XXXX" class="w-full bg-transparent text-2xl font-black tracking-widest uppercase focus:outline-none text-blue-600 placeholder-slate-200">
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-5 rounded-[1.25rem] shadow-xl shadow-blue-500/30 transition-all active:scale-95 uppercase tracking-widest text-xs">
                        REDEEM & CONNECT
                    </button>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex justify-between items-center">
                <div>
                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1.5 leading-none">Your Identity</p>
                    <p class="text-slate-800 text-[10px] font-extrabold font-mono">{{ $mac ?? '00:00:00:00:00:00' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1.5 leading-none">Support</p>
                    <button class="text-blue-600 text-[10px] font-extrabold hover:text-blue-800 transition-colors">HELP CENTER</button>
                </div>
            </div>
        </div>

        <div class="bg-slate-50/80 p-6 text-center border-t border-slate-100">
            <p class="text-slate-400 text-[9px] font-bold uppercase tracking-[0.2em] leading-none">Secured by Abella Systems</p>
        </div>
    </div>
    
    <style>
        .animate-spin-slow { animation: spin 8s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
</body>
</html>
