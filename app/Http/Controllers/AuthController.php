<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
{
    // Buscamos por 'email' y usamos los nombres correctos
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        session(['user_id' => $user->id, 'user_role' => $user->role]);
        return redirect('/dashboard');
    }

    return back()->with('error', 'Credenciales incorrectas');
}

    public function logout()
    {
        session()->forget(['user_id', 'user_role']);
        return redirect('/');
    }
}