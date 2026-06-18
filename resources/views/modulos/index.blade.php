@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-black">
    <div class="w-full max-w-sm">
        <div class="mb-12 text-center">
            <h1 class="text-white text-2xl font-light uppercase tracking-[0.5em]">TecnoSoluciones</h1>
            <div class="w-12 h-[1px] bg-emerald-500 mx-auto mt-4"></div>
        </div>
        
        <form action="{{ route('login') }}" method="POST" class="space-y-8">
            @csrf
            <div>
                <input type="email" name="email" placeholder="CORREO ELECTRÓNICO" required
                    class="w-full bg-transparent border-b border-white/20 p-2 text-white placeholder-gray-600 outline-none focus:border-emerald-500 transition">
            </div>
            <div>
                <input type="password" name="password" placeholder="CONTRASEÑA" required
                    class="w-full bg-transparent border-b border-white/20 p-2 text-white placeholder-gray-600 outline-none focus:border-emerald-500 transition">
            </div>
            <button type="submit" 
                class="w-full border border-emerald-500 text-emerald-500 py-3 uppercase tracking-[0.2em] text-[10px] hover:bg-emerald-500 hover:text-black transition font-bold">
                Ingresar
            </button>
        </form>
    </div>
</div>
@endsection