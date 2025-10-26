<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contacto;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contacto::create([
            'nombre' => 'Juan',
            'email' => 'juan@si.com',
            'telefono' => '123456789',
            'direccion' => 'Calle',
        ]);
    }
}