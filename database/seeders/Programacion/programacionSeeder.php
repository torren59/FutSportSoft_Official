<?php

namespace Database\Seeders\Programacion;

use App\Models\Programacion\Programacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class programacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i < 19; $i++){
            Programacion::factory()->create();
        }
    }
}
