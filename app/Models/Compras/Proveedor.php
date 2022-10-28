<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $primaryKey = 'Nit';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'NombreEmpresa',
        'Titular',
        'NumeroContacto',
        'Correo',
        'Direccion',
        'Estado',
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
