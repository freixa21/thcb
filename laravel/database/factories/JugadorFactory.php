<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory {
    protected $model = Jugador::class;

    public function definition() {
        return [
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'sexo' => $this->faker->randomElement(['H', 'D']),
            'talla' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'alergenos' => $this->faker->optional()->text(20),
            'after' => $this->faker->boolean(50),
            'equipo_id' => Equipo::factory(),
        ];
    }
}
