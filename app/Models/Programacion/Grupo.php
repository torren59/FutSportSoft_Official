<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $primaryKey = 'GrupoId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'CategoriaId',
        'Documento',
        'NombreGrupo',
        'Estado'
    ];

    protected $attributes = [
        'Estado' => true,
    ];

}
