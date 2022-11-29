<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;

    protected $table = 'tallas';

    protected $primaryKey = 'TallaId';

    public $incrementing = false;

    protected $keyType = 'varchar';

    public $timestamps = false;

    protected $fillable = [
        'Talla',

    ];
}
