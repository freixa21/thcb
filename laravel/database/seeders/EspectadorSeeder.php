<?php

namespace Database\Seeders;

use App\Models\Espectador;
use Illuminate\Database\Seeder;

class EspectadorSeeder extends Seeder
{
    public function run()
    {
        $espectadores = \App\Models\User::all();

        foreach ($espectadores as $espectador) {
            Espectador::factory()->count(1)->create([
                'usuario_id' => $espectador->id,
            ]);
        }
    }
}
