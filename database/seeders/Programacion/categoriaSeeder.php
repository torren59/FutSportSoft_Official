<?php

namespace Database\Seeders\Programacion;

use App\Models\Programacion\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i < 9; $i++){
            Categoria::factory()->create();
        }
    }
}
