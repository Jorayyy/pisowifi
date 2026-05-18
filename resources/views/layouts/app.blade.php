<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Piso WiFi Cloud' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 uppercase text-xs font-bold tracking-wider">
    <nav class="bg-blue-800 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl">PISO WIFI CLOUD</h1>
            <div class="space-x-6 flex items-center">
                <a href="{{ url('/') }}" class="hover:text-blue-300">DASHBOARD</a>
                <a href="{{ url('/franchises') }}" class="hover:text-blue-300">BRANCHES</a>
                <a href="{{ url('/devices') }}" class="hover:text-blue-300">DEVICES</a>
                <a href="{{ url('/clients') }}" class="hover:text-blue-300">CLIENTS</a>
                <a href="{{ url('/vouchers') }}" class="hover:text-blue-300">VOUCHERS</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-[10px]">LOGOUT</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        @yield('content')
    </main>
</body>
</html>
