<?php
<<<<<<< HEAD

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestionController;

// RUTA DE LOGIN
Route::get('/', function () { 
    return view('modulos.login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// GRUPO DE RUTAS
Route::middleware(['web'])->group(function () {
    Route::view('/dashboard', 'modulos.dashboard')->name('dashboard');
    Route::get('/gestion/{tabla}', [GestionController::class, 'index'])->name('gestion.index');
    Route::post('/gestion/{tabla}/{accion}', [GestionController::class, 'ejecutar'])->name('gestion.ejecutar');
}); // <--- ESTA ES LA ÚNICA LLAVE QUE CIERRA EL GRUPO
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionController;

Route::get('/', function () { return session()->has('usuario_id') ? redirect('/dashboard') : view('modulos.login'); })->name('login');
Route::post('/login', [GestionController::class, 'login'])->name('login.post');
Route::get('/logout', [GestionController::class, 'logout'])->name('logout');

Route::middleware(['check.session'])->group(function () {
    Route::view('/dashboard', 'modulos.dashboard')->name('dashboard');
    Route::get('/gestion/{tabla}', [GestionController::class, 'index'])->name('gestion.index');
    Route::post('/gestion/{tabla}/{accion}', [GestionController::class, 'ejecutar'])->name('gestion.ejecutar');
});
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
