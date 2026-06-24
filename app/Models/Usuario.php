<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'users'; // La tabla real es 'users'
    protected $primaryKey = 'id'; // La llave primaria es 'id'
    
    // Campos que existen en tu tabla
    protected $fillable = ['name', 'email', 'password', 'role'];
    
    protected $hidden = ['password'];
}