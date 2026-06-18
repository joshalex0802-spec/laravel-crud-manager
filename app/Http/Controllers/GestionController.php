<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        }
    }
}