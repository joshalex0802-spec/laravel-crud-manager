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
        <?php if(session('usuario_id')): ?>
        <div class="space-x-4">
            <span class="text-sm">Hola, <?php echo e(session('usuario_nombre')); ?></span>
            <a href="/dashboard" class="text-emerald-400">DASHBOARD</a>
            <a href="/logout" class="bg-red-600 px-3 py-1 rounded text-sm">Cerrar</a>
        </div>
        <?php endif; ?>
    </nav>
    <main class="p-8">
        <?php if(session('error')): ?> <div class="bg-red-100 text-red-700 p-4 mb-4 rounded"><?php echo e(session('error')); ?></div> <?php endif; ?>
        <?php if(session('success')): ?> <div class="bg-green-100 text-green-700 p-4 mb-4 rounded"><?php echo e(session('success')); ?></div> <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html><?php /**PATH C:\xampp\htdocs\ejercicio01laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>