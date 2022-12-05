<?php

namespace Database\Seeders\Programacion;

use App\Models\Programacion\Grupos_Deportistas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class grupo_deportistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i < 30; $i++){
            Grupos_Deportistas::factory()->create();
        }
    }
}
