<?php

namespace Database\Factories;

use App\Models\Jugador;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory {
    protected $model = Jugador::class;

    public function definition() {
        return [
            'nombre' => $this->faker->name,
            'talla' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'alergenos' => $this->faker->sentence(),
            'after' => $this->faker->boolean(),
            'sexo' => $this->faker->randomElement(['h', 'd']),
        ];
    }
}
