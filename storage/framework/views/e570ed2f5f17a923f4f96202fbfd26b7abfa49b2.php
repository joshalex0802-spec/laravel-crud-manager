<?php $__env->startSection('content'); ?>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ openAdd: false, openEdit: false, openDelete: false, item: {}, deleteForm: null }" class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-16">
        <div>
            <h2 class="text-5xl font-light uppercase tracking-tighter text-white"><?php echo e(str_replace('_', ' ', $tabla)); ?></h2>
        </div>
        <?php if(session('user_role') === 'Admin'): ?>
        <button @click="openAdd = true" class="text-[10px] uppercase tracking-widest border border-emerald-500 text-emerald-500 px-8 py-3 hover:bg-emerald-500 hover:text-black transition">Agregar Registro</button>
        <?php endif; ?>
    </div>

    <div class="glass overflow-hidden border border-white/10">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10">
                    <?php if($datos->isNotEmpty()): ?>
                        <?php $__currentLoopData = array_keys((array)$datos->first()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <th class="p-6 text-[9px] font-bold text-gray-500 uppercase tracking-[0.3em]"><?php echo e(str_replace('_', ' ', $col)); ?></th> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(session('user_role') === 'Admin'): ?>
                        <th class="p-6 text-[9px] font-bold text-gray-500 uppercase tracking-[0.3em] text-center">Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php $__empty_1 = true; $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-white/5 transition">
                    <?php $__currentLoopData = (array)$fila; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <td class="p-6 text-sm font-light text-gray-200"><?php echo e($v ?? '---'); ?></td> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(session('user_role') === 'Admin'): ?>
                    <td class="p-6 text-center flex gap-4 justify-center">
                        <button @click="openEdit = true; item = <?php echo e(json_encode($fila)); ?>" class="text-[9px] uppercase tracking-widest hover:text-emerald-500 transition">Editar</button>
                        <button @click="openDelete = true; deleteForm = $refs.delForm<?php echo e($loop->index); ?>" class="text-[9px] uppercase tracking-widest text-red-500 hover:text-red-300 transition">Borrar</button>
                        <form x-ref="delForm<?php echo e($loop->index); ?>" action="<?php echo e(route('gestion.ejecutar', [$tabla, 'eliminar'])); ?>" method="POST" class="hidden">
                            <?php echo csrf_field(); ?> <input type="hidden" name="id" value="<?php echo e(array_values((array)$fila)[0]); ?>">
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="100%" class="p-10 text-center text-gray-500 uppercase tracking-[0.2em] text-xs">Sin registros</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if(session('user_role') === 'Admin'): ?>
    <div x-show="openDelete" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50">
        <div class="glass p-12 rounded-none w-96 text-center border-white/20">
            <h3 class="font-light text-xl mb-8 uppercase tracking-widest">¿Eliminar registro?</h3>
            <div class="flex gap-4">
                <button @click="deleteForm.submit()" class="bg-red-600 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Confirmar</button>
                <button @click="openDelete = false" class="bg-white/10 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Cerrar</button>
            </div>
        </div>
    </div>

    <div x-show="openAdd || openEdit" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50">
        <form :action="openAdd ? '<?php echo e(route('gestion.ejecutar', [$tabla, 'agregar'])); ?>' : '<?php echo e(route('gestion.ejecutar', [$tabla, 'editar'])); ?>'" method="POST" class="glass p-12 rounded-none w-[450px] border-white/20">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" :value="openEdit ? Object.values(item)[0] : ''">
            <h3 class="font-light text-2xl mb-10 uppercase tracking-widest text-white" x-text="openAdd ? 'Nuevo' : 'Editar'"></h3>
            <?php $__currentLoopData = array_keys((array)$datos->first()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($col !== 'id'): ?>
                <div class="mb-6">
                    <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-2"><?php echo e(str_replace('_', ' ', $col)); ?></label>
                    <input type="text" name="<?php echo e($col); ?>" :value="openEdit ? item.<?php echo e($col); ?> : ''" class="w-full bg-transparent border-tech p-2 text-white outline-none focus:border-emerald-500 transition">
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="flex gap-4 mt-12">
                <button class="bg-emerald-500 text-black w-full py-3 text-[10px] uppercase font-bold tracking-widest hover:bg-emerald-400">Guardar</button>
                <button type="button" @click="openAdd=false; openEdit=false" class="bg-white/10 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Cerrar</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-crud-manager-0eec277baffc3a536c563a0b546fb0ab16e1f430\resources\views/modulos/index.blade.php ENDPATH**/ ?>