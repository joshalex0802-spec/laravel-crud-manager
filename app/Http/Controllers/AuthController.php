<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Buscamos al usuario por el 'email' (que es el name que tienes en tu formulario)
        $user = DB::table('users')->where('email', $request->email)->first();

        // 2. Verificamos si existe y si la contraseña es correcta
        if ($user && Hash::check($request->password, $user->password)) {
            // 3. Iniciamos sesión
            session(['user_id' => $user->id, 'user_role' => $user->role]);
            return redirect('/dashboard');
        }

        // 4. Si falla, regresamos al login con el error
        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_role']);
        return redirect('/');
    }
}