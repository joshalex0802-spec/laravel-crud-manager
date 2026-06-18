<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';
    public $timestamps = false; // Si no usas created_at/updated_at

    // IMPORTANTE: Agrega aquí todos los nombres de las columnas que quieres guardar
    protected $fillable = ['nombre', 'descripcion', 'estado', 'fecha_inicio', 'fecha_fin', 'id_cliente'];
}