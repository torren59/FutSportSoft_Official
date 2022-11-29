<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Producto extends Model
{
    use HasFactory;

    protected $table = 'tipos_productos';

    protected $primaryKey = 'TipoId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'Tipo',

    ];
}
