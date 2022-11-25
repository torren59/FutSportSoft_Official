<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    
    protected $table = 'permisos';

    protected $primaryKey = 'PermisoId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'NombrePermiso',
        'Descripcion'
    ];
}
