<?php

namespace Database\Seeders;

use App\Models\Jugador;
use Illuminate\Database\Seeder;

class JugadorSeeder extends Seeder
{
    public function run()
    {
        $equipos = \App\Models\Equipo::all();

        foreach ($equipos as $equipo) {
            Jugador::factory()->count(5)->create([
                'equipo_id' => $equipo->id,
            ]);
        }
    }
}
