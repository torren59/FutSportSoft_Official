<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;
    
    protected $table = 'deportes';

    protected $primaryKey = 'DeporteId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamp = false;

  public $Nombr;

    protected $fillable = [
        'NombreDeporte',
        'Estado',
    ];

    protected $attributes = [
        'Estado' => true,
    ];

}
