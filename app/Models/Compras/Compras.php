<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $primaryKey = 'NumeroFactura';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'Nit',
        'FechaCompra',
        'ValorCompra',
        'SubTotal',
        'Iva',
        'Descuento',
        'Estado',
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
