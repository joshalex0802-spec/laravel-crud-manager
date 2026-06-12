

<?php $__env->startSection('content'); ?>
    <h2 class="text-3xl font-bold mb-8">PANEL DE CONTROL</h2>
    <div class="grid grid-cols-3 gap-8">
        <?php $__currentLoopData = ['CLIENTES', 'PROYECTOS', 'TAREAS']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="/gestion/<?php echo e(strtolower($modulo)); ?>" 
           class="border-2 border-[#0F172A] p-10 hover:bg-[#0F172A] hover:text-white transition-all duration-300 block">
            <h3 class="text-2xl font-bold"><?php echo e($modulo); ?></h3>
            <p class="text-sm opacity-70">ACCESO A REGISTROS</p>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ejercicio01laravel\resources\views/modulos/dashboard.blade.php ENDPATH**/ ?>