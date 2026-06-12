@extends('layouts.app')

@section('content')
<div class="h-screen flex items-center justify-center">
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-xl border border-[#0F172A]">
        <h2 class="text-3xl font-bold mb-6 text-center text-[#0F172A]">TECNO<span class="text-[#10B981]">SOLUCIONES</span></h2>
        
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="email" name="correo" placeholder="Correo" required 
                       class="w-full p-3 bg-[#F8FAFC] border-b-2 border-[#0F172A] outline-none">
            </div>
            <div class="mb-6">
                <input type="password" name="password" placeholder="Contraseña" required 
                       class="w-full p-3 bg-[#F8FAFC] border-b-2 border-[#0F172A] outline-none">
            </div>
            <button type="submit" 
                    class="w-full bg-[#10B981] hover:bg-emerald-600 text-white font-bold py-3 transition">
                INGRESAR
            </button>
        </form>
    </div>
</div>
@endsection