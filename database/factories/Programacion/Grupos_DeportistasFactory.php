<?php

namespace Database\Factories\Programacion;

use App\Models\Programacion\Deportista;
use App\Models\Programacion\Grupo;
use App\Models\Programacion\Grupos_Deportistas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programacion\Grupos_Deportistas>
 */
class Grupos_DeportistasFactory extends Factory
{
    protected $model = Grupos_Deportistas::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $FechaIngreso = date('Y-m-d',mt_rand(32305707,36406808));

        return [
            'GruposDeportistasId' => (intval(Grupos_Deportistas::all()->max('GruposDeportistasId'))+1),
            'GrupoId' => Grupo::all()->random()->GrupoId,
            'Documento' => Deportista::all()->random()->Documento,
            'FechaIngreso' => $FechaIngreso,
        ];

    }
}
