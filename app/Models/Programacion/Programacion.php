<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    use HasFactory;

    protected $table = 'programacion';

    protected $primaryKey = 'ProgramacionId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'SedeId',
        'GrupoId',
        'HorarioId',
        'FechaInicio',
        'FechaFinalizacion'
    ];

}
