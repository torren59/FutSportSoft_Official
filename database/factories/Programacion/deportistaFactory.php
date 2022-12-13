<?php

namespace Database\Factories\Programacion;

use App\Models\Programacion\Deportista;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programacion\deportista>
 */
class deportistaFactory extends Factory
{
    protected $model = Deportista::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $FechaNacimiento = date('Y-m-d',mt_rand(12305707,16406808));
        return [
            'Documento' => (intval(Deportista::all()->max('Documento'))+1),
            'DocumentoAcudiente' => random_int(1000000,212344554),
            'TipoDocumento' => $this->faker->randomElement(['1','2','3']),
            'Nombre' => $this->faker->randomElement(['Juan','Armando','Eunicio','Andrés','Alberto','Poncho']).
            $this->faker->randomElement([' Tabarez', ' Zapata', ' Torres', ' Puerto', ' Carrasco', ' Álvarez']),
            'FechaNacimiento' => $FechaNacimiento,
            'Direccion' => $this->faker->sentence(5),
            'Celular' => strval(random_int(3003213245,3999999999)),
            'Correo' => $this->faker->email(),
            'Estado' => true,

        ];
    }
}
