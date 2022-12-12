<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deportista extends Model
{
    use HasFactory;

    protected $table = 'deportistas';

    protected $primaryKey = 'Documento';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'DocumentoAcudiente',
        'TipoDocumento',
        'Nombre',
        'FechaNacimiento',
        'Direccion',
        'Celular',
        'Correo',
        'Estado'
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
