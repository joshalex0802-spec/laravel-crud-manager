<?php
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