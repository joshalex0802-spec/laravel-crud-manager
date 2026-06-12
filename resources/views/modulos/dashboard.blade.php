@extends('layouts.app')

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
@endsection