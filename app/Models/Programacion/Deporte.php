<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;
    
    protected $table = 'deportes';

    protected $PrimaryKey = 'DeporteId';

    protected $NombreDeporte;

    Protected $Estado;

    public $incrementing = false;

    protected $KeyType = 'string';

    public $timestamp = false;

    protected $attributes = [
        'Estado' => true,
    ];
}
