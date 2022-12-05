<?php

namespace Database\Factories\Programacion;

use App\Models\Programacion\Categoria;
use App\Models\Programacion\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programacion\grupo>
 */
class grupoFactory extends Factory
{
    protected $model = Grupo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'GrupoId' => (intval(Grupo::all()->max('GrupoId'))+1),
            'CategoriaId' => Categoria::all()->random()->CategoriaId,
            'Documento' => '1007650000',
            'NombreGrupo' => $this->faker->randomElement(['Perros','Lobos','Tigres','Leones','Panteras'])
            .' - '
            .$this->faker->randomElement(['Itagüí','Paris','Manrique','San José']), 
            'Estado' => true
        ];
    }
}
