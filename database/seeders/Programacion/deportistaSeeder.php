<?php

namespace Database\Seeders\Programacion;

use App\Models\Programacion\Deportista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class deportistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i < 70; $i++){
            Deportista::factory()->create();
        }
    }
}
