<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProyectoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->sentence(3),
            'descripcion' => fake()->paragraph(),
            'fecha_inicio' => fake()->date(),
            'fecha_fin' => fake()->date(),
            'presupuesto' => fake()->randomFloat(2, 5000, 100000),
        ];
    }
}