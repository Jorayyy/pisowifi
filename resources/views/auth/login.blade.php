<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Piso WiFi Cloud</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-blue-600 uppercase italic">Piso WiFi</h1>
            <p class="text-gray-500">Admin Central Management</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="admin@example.com">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Password</label>
                <input type="password" name="password" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all shadow-lg active:scale-95">
                SECURE LOGIN
            </button>
        </form>

        <div class="mt-8 text-center border-t pt-4">
            <p class="text-gray-400 text-[10px] uppercase font-medium">Restricted Access. Credentials Required.</p>
        </div>
    </div>
</body>
</html>
