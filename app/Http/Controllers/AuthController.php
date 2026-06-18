<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = DB::table('users')->where('email', $request->correo)->first();

        if ($user && Hash::check($request->password, $user->password)) {
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