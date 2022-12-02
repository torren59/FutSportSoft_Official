<?php

namespace Database\Factories\Programacion;

use App\Models\Programacion\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programacion\categoria>
 */
class categoriaFactory extends Factory
{

    protected $model = Categoria::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'CategoriaId' => (intval(Categoria::all()->max('CategoriaId'))+1),
            'DeporteId' => '10',
            'NombreCategoria' =>' Sub - '.random_int(5,25).$this->faker->randomElement([' Masculino',' Femenino']),
            'RangoEdad' => random_int(5,25).'-'.random_int(5,25),
            'Estado' => true
        ];
    }
}
