<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo_Vendido extends Model
{
    use HasFactory;

    protected $table = 'articulos_vendidos';

    protected $primaryKey = 'ArticulosVendidosId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamp = false;

    protected $fillable = [
        'ProductoId',
        'VentaId',
        'Cantidad',
        'PrecioVenta',
    ];
}
