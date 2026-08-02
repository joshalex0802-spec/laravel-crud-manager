<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestionController;

// --- RUTAS PÚBLICAS (LOGIN) ---
Route::get('/', function () { 
    return view('modulos.login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// --- RUTAS PROTEGIDAS (REQUIEREN INICIO DE SESIÓN) ---
Route::middleware(['web'])->group(function () {
    
    // Panel de Control Principal (Valida sesión activa)
    Route::get('/dashboard', function () {
        if (!session()->has('user_id')) {
            return redirect('/')->with('error', 'Por favor, inicia sesión primero.');
        }
        return view('modulos.dashboard');
    })->name('dashboard');

    // Módulos de Gestión Dinámica (Productos, Ventas, Categorías, Proveedores, Usuarios)
    Route::get('/gestion/{tabla}', [GestionController::class, 'index'])->name('gestion.index');
    Route::post('/gestion/{tabla}/{accion}', [GestionController::class, 'ejecutar'])->name('gestion.ejecutar');

});