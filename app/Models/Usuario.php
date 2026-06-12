<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'Usuarios'; // Tu tabla real de MySQL
    protected $primaryKey = 'id_usuario'; // Tu llave primaria real
    public $timestamps = false; // Desactivamos esto porque no usamos 'created_at'

    protected $fillable = ['nombre', 'correo', 'contrasena', 'rol'];
    
    protected $hidden = ['contrasena']; // Oculta la clave en las consultas por seguridad

    // Le aclaramos a Laravel que la clave en tu tabla se llama 'contrasena' y no 'password'
    public function getAuthPassword() {
        return $this->contrasena;
    }
}