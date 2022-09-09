<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $table = 'sedes';

    protected $primaryKey = 'SedeId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'NombreSede',
        'Municipio',
        'Barrio',
        'Direccion',
        'Estado',
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
