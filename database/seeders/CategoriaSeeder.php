<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    use WithoutModelEvents;
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear categorías principales predefinidas
        $electronica = Categoria::create([
            'nombre' => 'Electrónica',
            'slug' => 'electronica',
            'descripcion' => 'Productos electrónicos y tecnología',
            'icono' => '📱',
            'color' => '#3B82F6',
            'orden' => 1,
            'activo' => true,
            'cantidad_productos' => 0,
        ]);

        $ropa = Categoria::create([
            'nombre' => 'Ropa y Moda',
            'slug' => 'ropa-moda',
            'descripcion' => 'Prendas de vestir y accesorios de moda',
            'icono' => '👕',
            'color' => '#EC4899',
            'orden' => 2,
            'activo' => true,
            'cantidad_productos' => 0,
        ]);

        $hogar = Categoria::create([
            'nombre' => 'Hogar y Jardín',
            'slug' => 'hogar-jardin',
            'descripcion' => 'Artículos para el hogar y jardín',
            'icono' => '🏠',
            'color' => '#10B981',
            'orden' => 3,
            'activo' => true,
            'cantidad_productos' => 0,
        ]);

        $deportes = Categoria::create([
            'nombre' => 'Deportes',
            'slug' => 'deportes',
            'descripcion' => 'Equipamiento deportivo y fitness',
            'icono' => '⚽',
            'color' => '#F59E0B',
            'orden' => 4,
            'activo' => true,
            'cantidad_productos' => 0,
        ]);

        $libros = Categoria::create([
            'nombre' => 'Libros y Educación',
            'slug' => 'libros-educacion',
            'descripcion' => 'Libros y material educativo',
            'icono' => '📚',
            'color' => '#8B5CF6',
            'orden' => 5,
            'activo' => true,
            'cantidad_productos' => 0,
        ]);

        // Crear subcategorías para Electrónica
        Categoria::create([
            'nombre' => 'Smartphones',
            'slug' => 'smartphones',
            'descripcion' => 'Teléfonos inteligentes y accesorios',
            'icono' => '📱',
            'color' => '#3B82F6',
            'orden' => 1,
            'categoria_padre_id' => $electronica->id,
            'activo' => true,
        ]);

        Categoria::create([
            'nombre' => 'Computadoras',
            'slug' => 'computadoras',
            'descripcion' => 'Laptops, PC y componentes',
            'icono' => '💻',
            'color' => '#3B82F6',
            'orden' => 2,
            'categoria_padre_id' => $electronica->id,
            'activo' => true,
        ]);

        // Crear subcategorías para Ropa
        Categoria::create([
            'nombre' => 'Ropa Hombre',
            'slug' => 'ropa-hombre',
            'descripcion' => 'Ropa y accesorios para hombre',
            'icono' => '👔',
            'color' => '#EC4899',
            'orden' => 1,
            'categoria_padre_id' => $ropa->id,
            'activo' => true,
        ]);

        Categoria::create([
            'nombre' => 'Ropa Mujer',
            'slug' => 'ropa-mujer',
            'descripcion' => 'Ropa y accesorios para mujer',
            'icono' => '👗',
            'color' => '#EC4899',
            'orden' => 2,
            'categoria_padre_id' => $ropa->id,
            'activo' => true,
        ]);

        // Crear subcategorías para Deportes
        Categoria::create([
            'nombre' => 'Fútbol',
            'slug' => 'futbol',
            'descripcion' => 'Equipamiento para fútbol',
            'icono' => '⚽',
            'color' => '#F59E0B',
            'orden' => 1,
            'categoria_padre_id' => $deportes->id,
            'activo' => true,
        ]);

        Categoria::create([
            'nombre' => 'Gimnasio',
            'slug' => 'gimnasio',
            'descripcion' => 'Equipamiento para gimnasio y fitness',
            'icono' => '🏋️',
            'color' => '#F59E0B',
            'orden' => 2,
            'categoria_padre_id' => $deportes->id,
            'activo' => true,
        ]);
    }
}
