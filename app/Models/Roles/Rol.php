<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'RolId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'NombreRol'
    ];

    protected $attributes = [
        'Estado' => true,
    ];

}
