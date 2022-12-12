<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_documento extends Model
{
    use HasFactory;

    protected $table = 'tipos_documentos';

    protected $primaryKey = 'TipoDocumento';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'Descripcion'
    ];

}
