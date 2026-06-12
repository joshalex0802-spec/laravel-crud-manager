<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TecnoSoluciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-900">
    <nav class="bg-gray-900 text-white p-4 flex justify-between items-center shadow-lg">
        <h1 class="font-bold text-xl uppercase tracking-widest">TECNO<span class="text-emerald-500">SOLUCIONES</span></h1>
        @if(session('usuario_id'))
        <div class="space-x-4">
            <span class="text-sm">Hola, {{ session('usuario_nombre') }}</span>
            <a href="/dashboard" class="text-emerald-400">DASHBOARD</a>
            <a href="/logout" class="bg-red-600 px-3 py-1 rounded text-sm">Cerrar</a>
        </div>
        @endif
    </nav>
    <main class="p-8">
        @if(session('error')) <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">{{ session('error') }}</div> @endif
        @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
        @yield('content')
    </main>
</body>
</html>