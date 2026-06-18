@extends('layouts.app')
@section('content')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<<<<<<< HEAD
<div x-data="{ openAdd: false, openEdit: false, openDelete: false, item: {}, deleteForm: null }" class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-16">
        <div>
            <h2 class="text-5xl font-light uppercase tracking-tighter text-white">{{ str_replace('_', ' ', $tabla) }}</h2>
        </div>
        @if(session('user_role') === 'Admin')
        <button @click="openAdd = true" class="text-[10px] uppercase tracking-widest border border-emerald-500 text-emerald-500 px-8 py-3 hover:bg-emerald-500 hover:text-black transition">Agregar Registro</button>
        @endif
    </div>

    <div class="glass overflow-hidden border border-white/10">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/10">
                    @if($datos->isNotEmpty())
                        @foreach(array_keys((array)$datos->first()) as $col) 
                            <th class="p-6 text-[9px] font-bold text-gray-500 uppercase tracking-[0.3em]">{{ str_replace('_', ' ', $col) }}</th> 
                        @endforeach
                    @endif
                    @if(session('user_role') === 'Admin')
                        <th class="p-6 text-[9px] font-bold text-gray-500 uppercase tracking-[0.3em] text-center">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($datos as $fila)
                <tr class="hover:bg-white/5 transition">
                    @foreach((array)$fila as $key => $v) 
                        <td class="p-6 text-sm font-light text-gray-200">{{ $v ?? '---' }}</td> 
                    @endforeach
                    @if(session('user_role') === 'Admin')
                    <td class="p-6 text-center flex gap-4 justify-center">
                        <button @click="openEdit = true; item = {{ json_encode($fila) }}" class="text-[9px] uppercase tracking-widest hover:text-emerald-500 transition">Editar</button>
                        <button @click="openDelete = true; deleteForm = $refs.delForm{{ $loop->index }}" class="text-[9px] uppercase tracking-widest text-red-500 hover:text-red-300 transition">Borrar</button>
=======
<div x-data="{ 
    openAdd: false, 
    openEdit: false, 
    openDelete: false, 
    item: {}, 
    deleteForm: null 
}" class="p-8 bg-gray-50 min-h-screen">

    <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-3xl font-extrabold text-gray-800 uppercase tracking-tight">Gestión de {{ $tabla }}</h2>
        <button @click="openAdd = true; item = {}" class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-6 py-2.5 rounded-lg font-semibold shadow-lg shadow-indigo-200">
            + AGREGAR NUEVO
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    @foreach(array_keys((array)$datos->first()) as $col) 
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-wider">{{ strtoupper($col) }}</th> 
                    @endforeach
                    <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($datos as $fila)
                <tr class="hover:bg-indigo-50/50 transition">
                    @foreach((array)$fila as $v) <td class="p-4 text-gray-700 font-medium">{{ $v }}</td> @endforeach
                    <td class="p-4 flex gap-2 justify-center">
                        <button @click="openEdit = true; item = {{ json_encode($fila) }}" class="text-indigo-600 hover:text-indigo-900 font-bold px-3 py-1 bg-indigo-50 rounded">Editar</button>
                        <button @click="openDelete = true; deleteForm = $refs.delForm{{ $loop->index }}" class="text-red-500 hover:text-red-700 font-bold px-3 py-1 bg-red-50 rounded">Eliminar</button>
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
                        <form x-ref="delForm{{ $loop->index }}" action="{{ route('gestion.ejecutar', [$tabla, 'eliminar']) }}" method="POST" class="hidden">
                            @csrf <input type="hidden" name="id" value="{{ array_values((array)$fila)[0] }}">
                        </form>
                    </td>
<<<<<<< HEAD
                    @endif
                </tr>
                @empty
                <tr><td colspan="100%" class="p-10 text-center text-gray-500 uppercase tracking-[0.2em] text-xs">Sin registros</td></tr>
                @endforelse
=======
                </tr>
                @endforeach
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
            </tbody>
        </table>
    </div>

<<<<<<< HEAD
    @if(session('user_role') === 'Admin')
    <div x-show="openDelete" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50">
        <div class="glass p-12 rounded-none w-96 text-center border-white/20">
            <h3 class="font-light text-xl mb-8 uppercase tracking-widest">¿Eliminar registro?</h3>
            <div class="flex gap-4">
                <button @click="deleteForm.submit()" class="bg-red-600 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Confirmar</button>
                <button @click="openDelete = false" class="bg-white/10 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Cerrar</button>
=======
    <div x-show="openDelete" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-80 text-center">
            <h3 class="font-bold text-lg mb-2">¿Estás seguro?</h3>
            <p class="text-gray-500 mb-6">Esta acción no se puede deshacer.</p>
            <div class="flex gap-2">
                <button @click="deleteForm.submit()" class="bg-red-600 text-white w-full py-2 rounded-lg font-bold">SÍ, ELIMINAR</button>
                <button @click="openDelete = false" class="bg-gray-200 text-gray-700 w-full py-2 rounded-lg font-bold">Cancelar</button>
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div x-show="openAdd || openEdit" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50">
        <form :action="openAdd ? '{{ route('gestion.ejecutar', [$tabla, 'agregar']) }}' : '{{ route('gestion.ejecutar', [$tabla, 'editar']) }}'" method="POST" class="glass p-12 rounded-none w-[450px] border-white/20">
            @csrf
            <input type="hidden" name="id" :value="openEdit ? Object.values(item)[0] : ''">
            <h3 class="font-light text-2xl mb-10 uppercase tracking-widest text-white" x-text="openAdd ? 'Nuevo' : 'Editar'"></h3>
            @foreach(array_keys((array)$datos->first()) as $col)
                @if($col !== 'id')
                <div class="mb-6">
                    <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-2">{{ str_replace('_', ' ', $col) }}</label>
                    <input type="text" name="{{ $col }}" :value="openEdit ? item.{{ $col }} : ''" class="w-full bg-transparent border-tech p-2 text-white outline-none focus:border-emerald-500 transition">
                </div>
                @endif
            @endforeach
            <div class="flex gap-4 mt-12">
                <button class="bg-emerald-500 text-black w-full py-3 text-[10px] uppercase font-bold tracking-widest hover:bg-emerald-400">Guardar</button>
                <button type="button" @click="openAdd=false; openEdit=false" class="bg-white/10 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Cerrar</button>
            </div>
        </form>
    </div>
    @endif
=======
    <div x-show="openAdd || openEdit" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <form :action="openAdd ? '{{ route('gestion.ejecutar', [$tabla, 'agregar']) }}' : '{{ route('gestion.ejecutar', [$tabla, 'editar']) }}'" method="POST" class="bg-white p-8 rounded-2xl shadow-2xl w-96">
            @csrf
            <input type="hidden" name="id" :value="openEdit ? Object.values(item)[0] : ''">
            
            <h3 class="font-bold text-xl mb-6 uppercase" x-text="openAdd ? 'Agregar Registro' : 'Editar Registro'"></h3>
            
            @foreach(array_keys((array)$datos->first()) as $col)
                @if($col !== array_keys((array)$datos->first())[0])
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">{{ $col }}</label>
                    <input type="text" 
                           name="{{ $col }}" 
                           :value="openEdit ? item.{{ $col }} : ''" 
                           class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                @endif
            @endforeach
            
            <div class="flex gap-2 mt-6">
                <button class="bg-indigo-600 text-white w-full py-3 rounded-lg font-bold hover:bg-indigo-700">GUARDAR</button>
                <button type="button" @click="openAdd=false; openEdit=false" class="bg-gray-200 text-gray-700 w-full py-3 rounded-lg font-bold">Cancelar</button>
            </div>
        </form>
    </div>
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
</div>
@endsection