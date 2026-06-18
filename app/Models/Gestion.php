<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Gestion extends Model
{
    // Lista blanca de tablas permitidas para evitar accesos indebidos
    protected static $tablasPermitidas = ['products', 'sales', 'categories', 'suppliers', 'users'];

    public static function obtenerDatos($tabla)
    {
        // Mejora 1: Seguridad. Validar que la tabla sea permitida
        if (!in_array($tabla, self::$tablasPermitidas)) {
            throw new \Exception("Tabla no autorizada.");
        }

        // Mejora 2: Manejo de JOINs optimizados
        if ($tabla == 'products') {
            return DB::table('products')
                ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
                ->select('products.id', 'products.name', 'products.stock', 'products.price', 
                         'categories.name as category_name', 'suppliers.name as supplier_name')
                ->get();
        }

        if ($tabla == 'sales') {
            return DB::table('sales')
                ->leftJoin('products', 'sales.product_id', '=', 'products.id')
                ->select('sales.id', 'products.name as product_name', 'sales.quantity', 'sales.total_price')
                ->get();
        }
        
        // Mejora 3: Verificación de existencia de tabla antes de consultar
        if (!Schema::hasTable($tabla)) {
            return collect(); // Retorna colección vacía si no existe
        }

        return DB::table($tabla)->get();
    }
}