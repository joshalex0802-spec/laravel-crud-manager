<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario; // Usando tu modelo correcto
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear el usuario Administrador oficial que necesitas
        Usuario::create([
            'name' => 'Admin',
            'email' => 'admin@tecnosoluciones.com',
            'password' => Hash::make('12345678'), // Contraseña por defecto: 12345678
            'role' => 'Admin'
        ]);

        // 2. Crear categorías de prueba
        DB::table('categories')->insert([
            ['name' => 'Laptops y Computadoras', 'description' => 'Equipos de cómputo portátiles y de escritorio'],
            ['name' => 'Herramientas', 'description' => 'Herramientas de construcción y ferretería'],
            ['name' => 'Accesorios', 'description' => 'Periféricos y componentes']
        ]);

        // 3. Crear proveedores de prueba
        DB::table('suppliers')->insert([
            ['name' => 'TechGlobal S.A.', 'phone' => '999888777', 'email' => 'contacto@techglobal.com'],
            ['name' => 'Ferretería Industrial Peru', 'phone' => '911222333', 'email' => 'ventas@ferreteriaperu.com']
        ]);

        // 4. Crear productos de prueba
        DB::table('products')->insert([
            ['name' => 'Laptop HP Pavilion', 'stock' => 10, 'price' => 750.00],
            ['name' => 'Martillo de Acero Reforzado', 'stock' => 25, 'price' => 25.50],
            ['name' => 'Teclado Mecánico RGB', 'stock' => 15, 'price' => 45.00]
        ]);
    }
}
