<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'producto_categoria',
            'producto_id',
            'categoria_id'
        );
    }
}