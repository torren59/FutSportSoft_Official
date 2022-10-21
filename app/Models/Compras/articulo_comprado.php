<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articulo_comprado extends Model
{
    use HasFactory;
    protected $table = 'articulos_comprados';

    protected $primaryKey = 'ArticulosCompradosId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'ProductoId',
        'NumeroFactura',
        'Cantidad',
        'PrecioCompra'
    ];
}
