<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'CategoriaId';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'DeporteId',
        'NombreCategoria',
        'RangoEdad',
        'Estado'
    ];

    protected $attributes = [
        'Estado' => true,
    ];

}
