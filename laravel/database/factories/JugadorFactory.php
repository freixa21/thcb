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
            'sexo' => $this->faker->randomElement(['hombre', 'mujer', 'otro']),
            'talla' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'alergenos' => $this->faker->optional()->text(20),
            'after' => $this->faker->boolean(50),
            'equipo_id' => Equipo::factory(),
        ];
    }
}
