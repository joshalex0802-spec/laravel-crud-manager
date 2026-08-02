<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products'; // Asegura que busque la tabla products

    protected $fillable = [
        'name',
        'stock',
        'price'
    ];
}
