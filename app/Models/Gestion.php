<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gestion extends Model
{
    public static function obtenerDatos($tabla)
    {
        // Si la tabla es productos, realizamos JOINs para mostrar nombres amigables
        if ($tabla == 'products') {
            return DB::table('products')
                ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
                ->select('products.id', 'products.name', 'products.stock', 'products.price', 'categories.name as category_name', 'suppliers.name as supplier_name')
                ->get();
        }

        // Si la tabla es ventas, realizamos JOIN para mostrar el nombre del producto
        if ($tabla == 'sales') {
            return DB::table('sales')
                ->leftJoin('products', 'sales.product_id', '=', 'products.id')
                ->select('sales.id', 'products.name as product_name', 'sales.quantity', 'sales.total_price')
                ->get();
        }
        
        // Para todas las demás tablas (users, categories, suppliers) devolvemos todo tal cual
        return DB::table($tabla)->get();
    }
}