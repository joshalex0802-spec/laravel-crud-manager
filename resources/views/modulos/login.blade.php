@extends('layouts.app')
@section('content')
<div class="flex justify-center items-center h-[60vh]">
    <form action="{{ route('login.post') }}" method="POST" class="glass p-16 w-[400px] border border-white/10">
        @csrf
        <h2 class="text-xs font-bold uppercase tracking-[0.3em] mb-12 text-center text-gray-400">Acceso a Estación</h2>
        <input type="text" name="correo" placeholder="USUARIO" class="w-full bg-transparent border-tech p-3 mb-8 outline-none focus:border-emerald-500 transition uppercase tracking-widest text-sm">
        <input type="password" name="password" placeholder="CLAVE" class="w-full bg-transparent border-tech p-3 mb-12 outline-none focus:border-emerald-500 transition uppercase tracking-widest text-sm">
        <button class="w-full bg-white text-black py-4 uppercase text-[10px] font-bold tracking-[0.2em] hover:bg-emerald-500 transition">Inciar Misión</button>
    </form>
</div>
@endsection