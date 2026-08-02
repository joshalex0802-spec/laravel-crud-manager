<?php

namespace App\Models;

use Illuminate\Database\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'contact',
        'phone',
        'email',
    ];
}
