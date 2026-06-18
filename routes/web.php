<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestionController;

Route::get('/', function () { 
    return view('modulos.login'); 
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web'])->group(function () {
    Route::view('/dashboard', 'modulos.dashboard')->name('dashboard');
    Route::get('/gestion/{tabla}', [GestionController::class, 'index'])->name('gestion.index');
    Route::post('/gestion/{tabla}/{accion}', [GestionController::class, 'ejecutar'])->name('gestion.ejecutar');
});
