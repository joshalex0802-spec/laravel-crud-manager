<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
use App\Models\Gestion;

class GestionController extends Controller
{
    public function index($tabla)
    {
        if (!session()->has('user_id')) return redirect('/');
        $datos = Gestion::obtenerDatos($tabla);
        return view('modulos.index', compact('datos', 'tabla'));
    }

    public function ejecutar(Request $request, $tabla, $accion)
    {
        if (session('user_role') !== 'Admin') {
            return back()->with('error', 'Acceso denegado: Solo administradores.');
        }

        try {
            $data = $request->except(['_token', 'id']);
            if ($accion == 'agregar') DB::table($tabla)->insert($data);
            elseif ($accion == 'editar') DB::table($tabla)->where('id', $request->id)->update($data);
            elseif ($accion == 'eliminar') DB::table($tabla)->where('id', $request->id)->delete();
            
            return back()->with('success', 'Operación realizada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
=======
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
>>>>>>> 0eec277baffc3a536c563a0b546fb0ab16e1f430
        }
    }
}