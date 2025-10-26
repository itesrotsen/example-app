<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Maximiliano',
            'email' => 'bmdp@system',
            'password' => bcrypt('12345678'),
        ]);

        Proyecto::factory()->create([
            'nombre' => 'Proyecto 1',
            'descripcion' => 'Descripción del Proyecto 1',
            'fecha_inicio' => '2024-01-01',
            'fecha_fin' => '2024-06-30',
            'presupuesto' => 10000,
        ]);
    }
}
