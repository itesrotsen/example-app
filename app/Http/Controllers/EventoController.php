<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource with calendar view.
     */
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        
        // Crear fecha del mes actual del calendario
        $currentDate = Carbon::createFromDate($year, $month, 1);
        
        // Obtener eventos del mes
        $eventos = Evento::delMes($year, $month)
                        ->orderBy('fecha_inicio')
                        ->get();
        
        // Obtener próximos eventos
        $proximosEventos = Evento::futuros()
                                ->orderBy('fecha_inicio')
                                ->take(5)
                                ->get();
        
        // Crear array de eventos por día para el calendario
        $eventosPorDia = [];
        foreach ($eventos as $evento) {
            $dia = $evento->fecha_inicio->day;
            if (!isset($eventosPorDia[$dia])) {
                $eventosPorDia[$dia] = [];
            }
            $eventosPorDia[$dia][] = $evento;
        }
        
        return view('eventos.index', compact('currentDate', 'eventosPorDia', 'proximosEventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'ubicacion' => 'nullable|string|max:255',
        ], [
            'nombre_evento.required' => 'El nombre del evento es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
        ]);

        Evento::create($validated);

        return redirect()->route('eventos.index')
                        ->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'ubicacion' => 'nullable|string|max:255',
        ], [
            'nombre_evento.required' => 'El nombre del evento es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
        ]);

        $evento->update($validated);

        return redirect()->route('eventos.index')
                        ->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        $evento->delete();

        return redirect()->route('eventos.index')
                        ->with('success', 'Evento eliminado exitosamente.');
    }
}
