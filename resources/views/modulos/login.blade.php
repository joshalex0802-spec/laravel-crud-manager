@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-sm">
        
        <div class="mb-12 text-center">
            <h1 class="text-white text-2xl font-light uppercase tracking-[0.5em]">TecnoSoluciones</h1>
            <div class="w-12 h-[1px] bg-emerald-500 mx-auto mt-4"></div>
        </div>
        
        <form action="{{ route('login.post') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="group">
                <!-- CORREGIDO: name="correo" para hacer match con el AuthController -->
                <input type="email" name="correo" placeholder="CORREO ELECTRÓNICO" required
                    class="w-full bg-transparent border-b border-white/20 p-2 text-white placeholder-gray-600 outline-none focus:border-emerald-500 transition-all duration-300">
            </div>

            <div class="group">
                <input type="password" name="password" placeholder="CONTRASEÑA" required
                    class="w-full bg-transparent border-b border-white/20 p-3 text-white placeholder-gray-600 outline-none focus:border-emerald-500 transition-all duration-300">
            </div>

            <button type="submit" 
                class="w-full border border-emerald-500 text-emerald-500 py-3 uppercase tracking-[0.2em] text-[10px] hover:bg-emerald-500 hover:text-black transition-all duration-300 font-bold">
                Ingresar
            </button>
        </form>

        @if (session('error') || $errors->any())
            <div class="mt-8 text-center">
                <p class="text-red-500 text-[10px] uppercase tracking-widest">Credenciales incorrectas</p>
            </div>
        @endif
    </div>
</div>
@endsection
