<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center h-[60vh]">
    <form action="<?php echo e(route('login.post')); ?>" method="POST" class="glass p-16 w-[400px] border border-white/10">
        <?php echo csrf_field(); ?>
        <h2 class="text-xs font-bold uppercase tracking-[0.3em] mb-12 text-center text-gray-400">Acceso a Estación</h2>
        <input type="text" name="correo" placeholder="USUARIO" class="w-full bg-transparent border-tech p-3 mb-8 outline-none focus:border-emerald-500 transition uppercase tracking-widest text-sm">
        <input type="password" name="password" placeholder="CLAVE" class="w-full bg-transparent border-tech p-3 mb-12 outline-none focus:border-emerald-500 transition uppercase tracking-widest text-sm">
        <button class="w-full bg-white text-black py-4 uppercase text-[10px] font-bold tracking-[0.2em] hover:bg-emerald-500 transition">Inciar Misión</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-crud-manager-0eec277baffc3a536c563a0b546fb0ab16e1f430\resources\views/modulos/login.blade.php ENDPATH**/ ?>