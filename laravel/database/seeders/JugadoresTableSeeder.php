<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Database\Seeder;

class JugadoresTableSeeder extends Seeder {
    public function run() {
        $equipos = Equipo::all();
        foreach ($equipos as $equipo) {
            Jugador::factory()->count(10)->create(['equipo_id' => $equipo->id]);
        }
    }
}
