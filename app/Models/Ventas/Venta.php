<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $primaryKey = 'VentaId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'Documento',
        'FechaVenta',
        'ValorVenta',
        'SubTotal',
        'IVA',
        'Descuento',
        'Estado',
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
