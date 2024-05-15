<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Espectador;
use Illuminate\Database\Eloquent\Factories\Factory;

class EspectadorFactory extends Factory
{
    protected $model = Espectador::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'apellidos' => $this->faker->lastName,
            'apellidos' => $this->faker->email,
            'sexo' => $this->faker->randomElement(['H', 'D']),
            'talla' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'alergenos' => $this->faker->optional()->text(20),
            'after' => $this->faker->boolean(50),
            'id_usuario' => User::factory(),
        ];
    }
}
