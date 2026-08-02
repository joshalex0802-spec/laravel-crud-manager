<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Sale;

class GestionController extends Controller
{
    // Lista blanca con los 5 módulos permitidos
    protected $tablasPermitidas = ['users', 'products', 'categories', 'suppliers', 'sales'];

    public function index($tabla)
    {
        // Verificar si el usuario está logueado por sesión
        if (!session()->has('user_id')) {
            return redirect('/');
        }
        
        // Validar que la tabla solicitada esté permitida
        if (!in_array($tabla, $this->tablasPermitidas)) {
            return back()->with('error', 'Módulo no permitido.');
        }

        // Carga de datos usando los modelos Eloquent limpios
        if ($tabla === 'users') {
            $datos = User::all();
        } elseif ($tabla === 'products') {
            $datos = Product::all();
        } elseif ($tabla === 'categories') {
            $datos = Category::all();
        } elseif ($tabla === 'suppliers') {
            $datos = Supplier::all();
        } elseif ($tabla === 'sales') {
            $datos = Sale::all();
        } else {
            $datos = collect();
        }

        return view('modulos.index', compact('datos', 'tabla'));
    }

    public function ejecutar(Request $request, $tabla, $accion)
    {
        // 1. Validar acceso de Administrador
        if (session('user_role') !== 'Admin') {
            return back()->with('error', 'Acceso denegado: Solo administradores.');
        }

        // 2. Validar que la tabla y la acción sean seguras
        if (!in_array($tabla, $this->tablasPermitidas) || !in_array($accion, ['agregar', 'editar', 'eliminar'])) {
            return back()->with('error', 'Operación no autorizada.');
        }

        try {
            // 3. Limpiar los datos del request (ignorar token e ID)
            $data = $request->except(['_token', 'id']);
            
            // Si es usuario y se modifica la contraseña, la encriptamos de forma segura
            if ($tabla === 'users') {
                if (isset($data['password']) && !empty($data['password'])) {
                    $data['password'] = bcrypt($data['password']);
                } else {
                    unset($data['password']); // No sobreescribir si llega vacía al editar
                }
            }

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