<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso_Rol extends Model
{
    use HasFactory;

    
    protected $table = 'permisos_roles';

    protected $primaryKey = 'PermisoRolId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'PermisoId',
        'RolId'
    ];
}
