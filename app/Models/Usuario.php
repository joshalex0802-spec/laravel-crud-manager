<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    // Usamos la tabla estándar 'users'
    protected $table = 'users';

    // Laravel espera que la llave primaria sea 'id'
    protected $primaryKey = 'id';

    // Campos permitidos para asignación masiva
    protected $fillable = ['name', 'email', 'password', 'role'];

    // Ocultar el password en las consultas
    protected $hidden = ['password'];
}