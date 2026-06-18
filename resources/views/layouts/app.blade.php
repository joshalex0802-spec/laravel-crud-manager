<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>TECNO-SOLUCIONES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #000; color: #ffffff; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .border-tech { border-bottom: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="min-h-screen">
    <nav class="glass border-b border-white/10 p-8 flex justify-between items-center">
        <h1 class="font-bold text-lg uppercase tracking-[0.4em]">TECNO<span class="text-emerald-500">SOLUCIONES</span></h1>
        @if(session('user_id'))
        <div class="flex items-center gap-8">
            <a href="/dashboard" class="text-[10px] uppercase tracking-widest text-emerald-500 hover:text-white transition">Dashboard</a>
            <a href="/logout" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-red-500 transition">Salir</a>
        </div>
        @endif
    </nav>
    <main class="p-10 md:p-20">
=======
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
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
        @yield('content')
    </main>
</body>
</html>