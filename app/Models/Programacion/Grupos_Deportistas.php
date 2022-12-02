<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos_Deportistas extends Model
{
    use HasFactory;

    protected $table = 'grupos_deportistas';

    protected $primaryKey = 'GruposDeportistasId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'GrupoId',
        'Documento',
        'FechaIngreso',
    ];

    protected $attributes = [
        'Estado' => true,
    ];
}
