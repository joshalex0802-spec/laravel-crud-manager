<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto">
    <h2 class="text-[10px] font-bold uppercase tracking-[0.5em] text-emerald-500 mb-6 text-center">Panel de Control</h2>
    <h3 class="text-5xl font-light mb-20 tracking-tighter uppercase text-center">Seleccionar Módulo</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php $__currentLoopData = ['users'=>'Usuarios', 'products'=>'Productos', 'categories'=>'Categorías', 'sales'=>'Ventas', 'suppliers'=>'Proveedores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link => $titulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="/gestion/<?php echo e($link); ?>" class="glass p-10 hover:border-emerald-500 transition-all group border border-white/5">
            <h3 class="text-sm font-bold uppercase tracking-[0.2em] group-hover:text-emerald-500"><?php echo e($titulo); ?></h3>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-crud-manager-0eec277baffc3a536c563a0b546fb0ab16e1f430\resources\views/modulos/dashboard.blade.php ENDPATH**/ ?>