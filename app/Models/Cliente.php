<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente'; // Asegúrate que coincida con tu BD
    public $timestamps = false; // Desactiva si no tienes campos created_at/updated_at
    
    protected $fillable = ['nombre', 'correo']; // Campos que permites editar
}