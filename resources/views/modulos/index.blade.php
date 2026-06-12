@extends('layouts.app')
@section('content')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
                        <form x-ref="delForm{{ $loop->index }}" action="{{ route('gestion.ejecutar', [$tabla, 'eliminar']) }}" method="POST" class="hidden">
                            @csrf <input type="hidden" name="id" value="{{ array_values((array)$fila)[0] }}">
                        </form>
                    </td>
                </tr>
                @endforeach
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
</div>
@endsection