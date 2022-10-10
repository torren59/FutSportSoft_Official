<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = 'Documento';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'Documento', 'Nombre', 'RolId', 'Direccion', 'Celular', 'Correo', 'Direccion', 'FechaNacimiento', 'Clave'
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
