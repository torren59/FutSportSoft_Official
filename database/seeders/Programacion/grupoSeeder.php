<?php

namespace Database\Seeders\Programacion;

use App\Models\Programacion\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class grupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i < 19; $i++){
            Grupo::factory()->create();
        }

        $this->call([
            programacionSeeder::class,
            grupo_deportistaSeeder::class,
        ]);
    }
}
