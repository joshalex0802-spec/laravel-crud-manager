@extends('layouts.app')
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
@endsection