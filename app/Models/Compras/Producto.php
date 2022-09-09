<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'ProductoId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamp = false;

    protected $fillable = [
        'NombreProducto',
        'TipoProducto',
        'Talla',
        'PrecioVenta',
        'Cantidad',
        'Estado',
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
