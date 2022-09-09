<?php

namespace App\Models\Ayudas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
    use HasFactory;

    protected $table = 'ayudas';

    protected $primaryKey = 'AyudaId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamp = false;

    protected $fillable = [
        'NombreAyuda',
        'Enlace',
    ];
}
