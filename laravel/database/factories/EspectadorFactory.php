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
            'sexo' => $this->faker->randomElement(['hombre', 'mujer', 'otro']),
            'talla' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'alergenos' => $this->faker->optional()->text(20),
            'after' => $this->faker->boolean(50),
            'usuario_id' => User::factory(),
            'pagado' => $this->faker->boolean(50),
            'pago_confirmado' => $this->faker->boolean(50),
        ];
    }
}
