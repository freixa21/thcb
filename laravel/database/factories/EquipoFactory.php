<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Equipo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    protected $model = Equipo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'id_usuario' => User::factory(),
        ];
    }
}
