<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gestion;
use Illuminate\Support\Facades\Schema;

class GestionController extends Controller
{
    // Lista blanca para proteger las rutas
    protected $tablasPermitidas = ['products', 'sales', 'categories', 'suppliers', 'users'];

    public function index($tabla)
    {
        // Verificar si el usuario está logueado
        if (!session()->has('user_id')) {
            return redirect('/');
        }
        
        // Validar que la tabla solicitada esté permitida
        if (!in_array($tabla, $this->tablasPermitidas)) {
            return back()->with('error', 'Tabla no permitida.');
        }

        // Carga dinámica usando Eloquent para las tablas con relaciones
        if ($tabla === 'products') {
            $datos = \App\Models\Product::with(['category', 'supplier'])->get();
        } elseif ($tabla === 'sales') {
            $datos = \App\Models\Sale::with('product')->get();
        } else {
            // Para las tablas simples (categories, suppliers, users)
            $datos = Gestion::obtenerDatos($tabla);
        }

        return view('modulos.index', compact('datos', 'tabla'));
    }

    public function ejecutar(Request $request, $tabla, $accion)
    {
        // 1. Validar acceso de Admin
        if (session('user_role') !== 'Admin') {
            return back()->with('error', 'Acceso denegado: Solo administradores.');
        }

        // 2. Validar que la tabla y la acción sean seguras
        if (!in_array($tabla, $this->tablasPermitidas) || !in_array($accion, ['agregar', 'editar', 'eliminar'])) {
            return back()->with('error', 'Operación no autorizada.');
        }

        try {
            // 3. Limpiar los datos del request (ignorar el token de seguridad e ID)
            $data = $request->except(['_token', 'id']);
            
            // Ejecución de la operación en la base de datos
            if ($accion == 'agregar') {
                DB::table($tabla)->insert($data);
            } elseif ($accion == 'editar') {
                DB::table($tabla)->where('id', $request->id)->update($data);
            } elseif ($accion == 'eliminar') {
                DB::table($tabla)->where('id', $request->id)->delete();
            }
            
            return back()->with('success', 'Operación realizada correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}