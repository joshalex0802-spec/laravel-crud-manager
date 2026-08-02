@extends('layouts.app')

@section('content')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ openAdd: false, openEdit: false, openDelete: false, item: {}, deleteForm: null }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
        <h2 class="text-3xl sm:text-5xl font-light uppercase tracking-tighter text-white">
            {{ str_replace('_', ' ', $tabla) }}
        </h2>
        @if(session('user_role') === 'Admin')
        <button @click="openAdd = true" class="w-full sm:w-auto text-[10px] uppercase tracking-widest border border-emerald-500 text-emerald-500 px-8 py-3 hover:bg-emerald-500 hover:text-black transition">
            Agregar Registro
        </button>
        @endif
    </div>

    <div class="glass overflow-x-auto border border-white/10 bg-black/20">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/10">
                    @if($datos->isNotEmpty())
    @foreach(array_keys((array)$datos->first()->getAttributes()) as $col)
        @if($col !== 'id' && $col !== 'created_at' && $col !== 'updated_at' && $col !== 'email_verified_at' && $col !== 'remember_token')
        <div class="mb-6">
            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-2">{{ str_replace('_', ' ', $col) }}</label>
            <input type="{{ $col === 'password' ? 'password' : 'text' }}" name="{{ $col }}" :value="openEdit ? item.{{ $col }} : ''" class="w-full bg-transparent border-b border-white/20 p-2 text-white outline-none focus:border-emerald-500 transition">
        </div>
        @endif
    @endforeach
@else
    {{-- Si la tabla está vacía, le pedimos las columnas directamente a la tabla de la base de datos --}}
    @foreach(Schema::getColumnListing($tabla) as $col)
        @if($col !== 'id' && $col !== 'created_at' && $col !== 'updated_at' && $col !== 'email_verified_at' && $col !== 'remember_token')
        <div class="mb-6">
            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-2">{{ str_replace('_', ' ', $col) }}</label>
            <input type="{{ $col === 'password' ? 'password' : 'text' }}" name="{{ $col }}" :value="openEdit ? item.{{ $col }} : ''" class="w-full bg-transparent border-b border-white/20 p-2 text-white outline-none focus:border-emerald-500 transition">
        </div>
        @endif
    @endforeach
@endif
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($datos as $fila)
                <tr class="hover:bg-white/5 transition">
                    @foreach($fila->toArray() as $key => $v) 
                        @if($key !== 'password' && $key !== 'remember_token')
                        <td class="p-4 sm:p-6 text-sm font-light text-gray-200 whitespace-nowrap">
                            @if($key === 'category_id' && isset($fila->category))
                                {{ $fila->category->name }}
                            @elseif($key === 'supplier_id' && isset($fila->supplier))
                                {{ $fila->supplier->name }}
                            @elseif(is_array($v) || is_object($v))
                                {{ json_encode($v) }}
                            @else
                                {{ $v ?? '---' }}
                            @endif
                        </td> 
                        @endif
                    @endforeach
                    @if(session('user_role') === 'Admin')
                    <td class="p-4 sm:p-6 text-center flex gap-4 justify-center">
                        <button @click="openEdit = true; item = {{ json_encode($fila) }}" class="text-[9px] uppercase tracking-widest hover:text-emerald-500 transition">Editar</button>
                        <button @click="openDelete = true; deleteForm = $refs.delForm{{ $loop->index }}" class="text-[9px] uppercase tracking-widest text-red-500 hover:text-red-300 transition">Borrar</button>
                        <form x-ref="delForm{{ $loop->index }}" action="{{ route('gestion.ejecutar', [$tabla, 'eliminar']) }}" method="POST" class="hidden">
                            @csrf <input type="hidden" name="id" value="{{ $fila->id }}">
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="100%" class="p-10 text-center text-gray-500 uppercase tracking-[0.2em] text-xs">Sin registros</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(session('user_role') === 'Admin')
    <div x-show="openDelete" class="fixed inset-0 bg-black/90 flex items-center justify-center z-50 p-4" style="display: none;">
        <div class="glass p-8 sm:p-12 w-full max-w-sm text-center border-white/20">
            <h3 class="font-light text-xl mb-8 uppercase tracking-widest text-white">¿Eliminar registro?</h3>
            <div class="flex gap-4">
                <button @click="deleteForm.submit()" class="bg-red-600 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Confirmar</button>
                <button @click="openDelete = false" class="bg-white/10 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Cerrar</button>
            </div>
        </div>
    </div>

    <div x-show="openAdd || openEdit" class="fixed inset-0 bg-black/90 flex items-center justify-center z-50 p-4" style="display: none;">
        <form :action="openAdd ? '{{ route('gestion.ejecutar', [$tabla, 'agregar']) }}' : '{{ route('gestion.ejecutar', [$tabla, 'editar']) }}'" method="POST" class="glass p-8 sm:p-12 w-full max-w-md border-white/20 max-h-[90vh] overflow-y-auto">
            @csrf
            <input type="hidden" name="id" :value="openEdit ? item.id : ''">
            <h3 class="font-light text-2xl mb-10 uppercase tracking-widest text-white" x-text="openAdd ? 'Nuevo' : 'Editar'"></h3>
            
            @if($datos->isNotEmpty())
                @foreach(array_keys((array)$datos->first()->getAttributes()) as $col)
                    @if($col !== 'id' && $col !== 'created_at' && $col !== 'updated_at' && $col !== 'email_verified_at' && $col !== 'remember_token')
                    <div class="mb-6">
                        <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-2">{{ str_replace('_', ' ', $col) }}</label>
                        <input type="{{ $col === 'password' ? 'password' : 'text' }}" name="{{ $col }}" :value="openEdit ? item.{{ $col }} : ''" class="w-full bg-transparent border-b border-white/20 p-2 text-white outline-none focus:border-emerald-500 transition">
                    </div>
                    @endif
                @endforeach
            @endif

            <div class="flex gap-4 mt-12">
                <button class="bg-emerald-500 text-black w-full py-3 text-[10px] uppercase font-bold tracking-widest hover:bg-emerald-400">Guardar</button>
                <button type="button" @click="openAdd=false; openEdit=false" class="bg-white/10 text-white w-full py-3 text-[10px] uppercase font-bold tracking-widest">Cerrar</button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection