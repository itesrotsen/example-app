<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Evento;
use Carbon\Carbon;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventos = [
            [
                'nombre_evento' => 'Reunión de Planificación',
                'descripcion' => 'Reunión mensual para revisar el progreso del proyecto y planificar las próximas tareas.',
                'fecha_inicio' => Carbon::now()->addDays(3)->setTime(10, 0),
                'fecha_fin' => Carbon::now()->addDays(3)->setTime(12, 0),
                'ubicacion' => 'Sala de Conferencias A',
            ],
            [
                'nombre_evento' => 'Presentación de Resultados Q4',
                'descripcion' => 'Presentación de los resultados del cuarto trimestre a todos los stakeholders.',
                'fecha_inicio' => Carbon::now()->addDays(7)->setTime(14, 0),
                'fecha_fin' => Carbon::now()->addDays(7)->setTime(16, 30),
                'ubicacion' => 'Auditorio Principal',
            ],
            [
                'nombre_evento' => 'Workshop de Desarrollo Web',
                'descripcion' => 'Taller práctico sobre las últimas tecnologías en desarrollo web. Se cubrirán temas como Laravel, Vue.js y mejores prácticas.',
                'fecha_inicio' => Carbon::now()->addDays(10)->setTime(9, 0),
                'fecha_fin' => Carbon::now()->addDays(10)->setTime(17, 0),
                'ubicacion' => 'Centro de Capacitación - Sala 3',
            ],
            [
                'nombre_evento' => 'Almuerzo de Equipo',
                'descripcion' => 'Almuerzo mensual de integración del equipo de desarrollo.',
                'fecha_inicio' => Carbon::now()->addDays(5)->setTime(13, 0),
                'fecha_fin' => Carbon::now()->addDays(5)->setTime(15, 0),
                'ubicacion' => 'Restaurante El Buen Sabor',
            ],
            [
                'nombre_evento' => 'Sesión de Code Review',
                'descripcion' => 'Revisión de código del sprint actual y retroalimentación del equipo.',
                'fecha_inicio' => Carbon::now()->addDays(2)->setTime(15, 0),
                'fecha_fin' => Carbon::now()->addDays(2)->setTime(17, 0),
                'ubicacion' => 'Sala de Reuniones B',
            ],
            [
                'nombre_evento' => 'Webinar: Seguridad en Aplicaciones',
                'descripcion' => 'Seminario web sobre las mejores prácticas de seguridad en el desarrollo de aplicaciones.',
                'fecha_inicio' => Carbon::now()->addDays(14)->setTime(16, 0),
                'fecha_fin' => Carbon::now()->addDays(14)->setTime(18, 0),
                'ubicacion' => 'Zoom - Link enviado por email',
            ],
            [
                'nombre_evento' => 'Celebración Cumpleaños Juan',
                'descripcion' => '¡Celebremos el cumpleaños de nuestro compañero Juan!',
                'fecha_inicio' => Carbon::now()->addDays(8)->setTime(17, 30),
                'fecha_fin' => Carbon::now()->addDays(8)->setTime(19, 30),
                'ubicacion' => 'Oficina - Área de descanso',
            ],
            [
                'nombre_evento' => 'Sprint Planning',
                'descripcion' => 'Planificación del nuevo sprint. Revisión del backlog y asignación de tareas.',
                'fecha_inicio' => Carbon::now()->addDays(1)->setTime(9, 30),
                'fecha_fin' => Carbon::now()->addDays(1)->setTime(11, 30),
                'ubicacion' => 'Sala de Reuniones A',
            ],
            [
                'nombre_evento' => 'Demo Day',
                'descripcion' => 'Demostración de las nuevas funcionalidades desarrolladas durante el sprint.',
                'fecha_inicio' => Carbon::now()->addDays(15)->setTime(11, 0),
                'fecha_fin' => Carbon::now()->addDays(15)->setTime(12, 30),
                'ubicacion' => 'Sala Principal',
            ],
            [
                'nombre_evento' => 'Capacitación MySQL Avanzado',
                'descripcion' => 'Curso de optimización de consultas y mejores prácticas en bases de datos MySQL.',
                'fecha_inicio' => Carbon::now()->addDays(20)->setTime(10, 0),
                'fecha_fin' => Carbon::now()->addDays(20)->setTime(13, 0),
                'ubicacion' => 'Centro de Capacitación - Sala 1',
            ],
        ];

        foreach ($eventos as $evento) {
            Evento::create($evento);
        }

        $this->command->info('✓ ' . count($eventos) . ' eventos de ejemplo creados exitosamente!');
    }
}
