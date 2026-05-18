<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piso WiFi Captive Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

            <div class="space-y-4">
                <div class="border-2 border-gray-100 rounded-xl p-4">
                    <label class="block text-gray-400 text-[10px] font-bold uppercase mb-1">Voucher Code</label>
                    <input type="text" placeholder="ENTER CODE HERE" class="w-full text-xl font-bold tracking-widest uppercase focus:outline-none text-blue-600 placeholder-gray-300">
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition-transform active:scale-95">
                    CONNECT NOW
                </button>
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
