<?php

namespace App\Models;

use Illuminate\Database\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales'; // Asegura que busque la tabla sales

    protected $fillable = [
        'total'
    ];
}
