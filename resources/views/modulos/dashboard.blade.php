@extends('layouts.app')
<<<<<<< HEAD
@section('content')
<div class="max-w-5xl mx-auto">
    <h2 class="text-[10px] font-bold uppercase tracking-[0.5em] text-emerald-500 mb-6 text-center">Panel de Control</h2>
    <h3 class="text-5xl font-light mb-20 tracking-tighter uppercase text-center">Seleccionar Módulo</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach(['users'=>'Usuarios', 'products'=>'Productos', 'categories'=>'Categorías', 'sales'=>'Ventas', 'suppliers'=>'Proveedores'] as $link => $titulo)
        <a href="/gestion/{{$link}}" class="glass p-10 hover:border-emerald-500 transition-all group border border-white/5">
            <h3 class="text-sm font-bold uppercase tracking-[0.2em] group-hover:text-emerald-500">{{$titulo}}</h3>
        </a>
        @endforeach
    </div>
</div>
=======

@section('content')
    <h2 class="text-3xl font-bold mb-8">PANEL DE CONTROL</h2>
    <div class="grid grid-cols-3 gap-8">
        @foreach(['CLIENTES', 'PROYECTOS', 'TAREAS'] as $modulo)
        <a href="/gestion/{{ strtolower($modulo) }}" 
           class="border-2 border-[#0F172A] p-10 hover:bg-[#0F172A] hover:text-white transition-all duration-300 block">
            <h3 class="text-2xl font-bold">{{ $modulo }}</h3>
            <p class="text-sm opacity-70">ACCESO A REGISTROS</p>
        </a>
        @endforeach
    </div>
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
@endsection