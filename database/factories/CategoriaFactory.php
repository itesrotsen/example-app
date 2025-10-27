<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaFactory extends Factory
{
    public function definition(): array
    {
        $nombre = fake()->unique()->words(2, true);
        
        return [
            'nombre' => ucfirst($nombre),
            'slug' => Str::slug($nombre),
            'descripcion' => fake()->sentence(10),
            'icono' => fake()->randomElement(['📱', '👕', '🏠', '⚽', '📚', '🎮', '🍕', '✈️', '💻', '🎵']),
            'color' => fake()->hexColor(),
            'orden' => fake()->numberBetween(0, 100),
            'activo' => fake()->boolean(80), // 80% de probabilidad de estar activo
            'cantidad_productos' => fake()->numberBetween(0, 50),
        ];
    }

    /**
     * Indicate that the category is inactive.
     */
    public function inactiva()
    {
        return $this->state(fn (array $attributes) => [
            'activo' => false,
        ]);
    }

    /**
     * Indicate that the category is a main category (no parent).
     */
    public function principal()
    {
        return $this->state(fn (array $attributes) => [
            'categoria_padre_id' => null,
        ]);
    }
}
