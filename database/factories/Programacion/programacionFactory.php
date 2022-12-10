<?php

namespace Database\Factories\Programacion;

use App\Models\Programacion\Grupo;
use App\Models\Programacion\Horario;
use App\Models\Programacion\Programacion;
use App\Models\Programacion\Sede;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programacion\programacion>
 */
class programacionFactory extends Factory
{
    protected $model = Programacion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $FechaInicio = date('Y-m-d',mt_rand(1577836800,1672444800));
        $FechaFinal = date('Y-m-d',strtotime('+1 month',strtotime($FechaInicio)));
        return [
            'ProgramacionId' => (intval(Programacion::all()->max('ProgramacionId'))+1),
            'SedeId' => Sede::all()->random()->SedeId,
            'GrupoId' => Grupo::all()->random()->GrupoId,
            'HorarioId' => Horario::all()->random()->HorarioId,
            'FechaInicio' => $FechaInicio,
            'FechaFinalizacion' => $FechaFinal,
            'Estado'=> true
        ];
    }
}
