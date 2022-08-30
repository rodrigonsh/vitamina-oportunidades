<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oportunidade extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'vendedor_id',
        'produto_id',
        'cliente_id'
    ];
}
