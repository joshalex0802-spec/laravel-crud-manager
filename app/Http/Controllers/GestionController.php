<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class GestionController extends BaseController {

    public function login(Request $request) {
        $usuario = DB::table('usuarios')->where('correo', $request->correo)->first();
        if ($usuario && Hash::check($request->password, $usuario->contrasena)) {
            session(['usuario_id' => $usuario->id_usuario, 'usuario_nombre' => $usuario->nombre, 'usuario_rol' => $usuario->rol]);
            return redirect('/dashboard');
        }
        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout() {
        session()->flush();
        return redirect('/');
    }

    public function index($tabla) {
        $datos = ($tabla == 'tareas') 
            ? DB::table('tareas')->join('proyectos', 'tareas.id_proyecto', '=', 'proyectos.id_proyecto')->select('tareas.*', 'proyectos.nombre as nombre_proyecto')->get()
            : DB::table($tabla)->get();
        return view('modulos.index', compact('datos', 'tabla'));
    }

    public function ejecutar(Request $request, $tabla, $accion) {
        if (session('usuario_rol') !== 'Admin') return back()->with('error', 'Acceso denegado.');

        $id_campo = ($tabla == 'usuarios') ? 'id_usuario' : 'id_' . rtrim($tabla, 's');
        
        try {
            if ($accion == 'agregar') {
                DB::table($tabla)->insert($request->except(['_token', 'id']));
            } elseif ($accion == 'eliminar') {
                DB::table($tabla)->where($id_campo, $request->id)->delete();
            } elseif ($accion == 'editar') {
                DB::table($tabla)->where($id_campo, $request->id)->update($request->except(['_token', 'id']));
            }
            return back()->with('success', 'Operación exitosa');
        } catch (\Exception $e) {
            return back()->with('error', 'Error en la operación.');
        }
    }
}