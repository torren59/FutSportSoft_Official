<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
{
    use HasFactory;

    protected $table = 'acudientes';

    protected $primaryKey = 'DocumentoAcudiente';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'NombreAcudiente',
        'CorreoAcudiente',
        'CelularAcudiente',

    ];
}
