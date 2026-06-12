
<?php $__env->startSection('content'); ?>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ 
    openAdd: false, 
    openEdit: false, 
    openDelete: false, 
    item: {}, 
    deleteForm: null 
}" class="p-8 bg-gray-50 min-h-screen">

    <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-3xl font-extrabold text-gray-800 uppercase tracking-tight">Gestión de <?php echo e($tabla); ?></h2>
        <button @click="openAdd = true; item = {}" class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-6 py-2.5 rounded-lg font-semibold shadow-lg shadow-indigo-200">
            + AGREGAR NUEVO
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <?php $__currentLoopData = array_keys((array)$datos->first()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider"><?php echo e(strtoupper($col)); ?></th> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-indigo-50/50 transition">
                    <?php $__currentLoopData = (array)$fila; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <td class="p-4 text-gray-700 font-medium"><?php echo e($v); ?></td> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td class="p-4 flex gap-2 justify-center">
                        <button @click="openEdit = true; item = <?php echo e(json_encode($fila)); ?>" class="text-indigo-600 hover:text-indigo-900 font-bold px-3 py-1 bg-indigo-50 rounded">Editar</button>
                        <button @click="openDelete = true; deleteForm = $refs.delForm<?php echo e($loop->index); ?>" class="text-red-500 hover:text-red-700 font-bold px-3 py-1 bg-red-50 rounded">Eliminar</button>
                        <form x-ref="delForm<?php echo e($loop->index); ?>" action="<?php echo e(route('gestion.ejecutar', [$tabla, 'eliminar'])); ?>" method="POST" class="hidden">
                            <?php echo csrf_field(); ?> <input type="hidden" name="id" value="<?php echo e(array_values((array)$fila)[0]); ?>">
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div x-show="openDelete" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-80 text-center">
            <h3 class="font-bold text-lg mb-2">¿Estás seguro?</h3>
            <p class="text-gray-500 mb-6">Esta acción no se puede deshacer.</p>
            <div class="flex gap-2">
                <button @click="deleteForm.submit()" class="bg-red-600 text-white w-full py-2 rounded-lg font-bold">SÍ, ELIMINAR</button>
                <button @click="openDelete = false" class="bg-gray-200 text-gray-700 w-full py-2 rounded-lg font-bold">Cancelar</button>
            </div>
        </div>
    </div>

    <div x-show="openAdd || openEdit" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <form :action="openAdd ? '<?php echo e(route('gestion.ejecutar', [$tabla, 'agregar'])); ?>' : '<?php echo e(route('gestion.ejecutar', [$tabla, 'editar'])); ?>'" method="POST" class="bg-white p-8 rounded-2xl shadow-2xl w-96">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" :value="openEdit ? Object.values(item)[0] : ''">
            
            <h3 class="font-bold text-xl mb-6 uppercase" x-text="openAdd ? 'Agregar Registro' : 'Editar Registro'"></h3>
            
            <?php $__currentLoopData = array_keys((array)$datos->first()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($col !== array_keys((array)$datos->first())[0]): ?>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1"><?php echo e($col); ?></label>
                    <input type="text" 
                           name="<?php echo e($col); ?>" 
                           :value="openEdit ? item.<?php echo e($col); ?> : ''" 
                           class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <div class="flex gap-2 mt-6">
                <button class="bg-indigo-600 text-white w-full py-3 rounded-lg font-bold hover:bg-indigo-700">GUARDAR</button>
                <button type="button" @click="openAdd=false; openEdit=false" class="bg-gray-200 text-gray-700 w-full py-3 rounded-lg font-bold">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ejercicio01laravel\resources\views/modulos/index.blade.php ENDPATH**/ ?>