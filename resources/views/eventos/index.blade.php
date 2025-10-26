@extends('layouts.app')

@section('title', 'Calendario de Eventos')

@push('styles')
<style>
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .calendar-navigation {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .calendar-navigation h2 {
        color: #667eea;
        font-size: 1.75rem;
        min-width: 200px;
        text-align: center;
    }

    .nav-btn {
        background: white;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .nav-btn:hover {
        background: #667eea;
        color: white;
    }

    .calendar-grid {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: bold;
        text-align: center;
    }

    .calendar-weekdays div {
        padding: 1rem;
        border-right: 1px solid rgba(255,255,255,0.2);
    }

    .calendar-weekdays div:last-child {
        border-right: none;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background: #e0e0e0;
    }

    .calendar-day {
        background: white;
        min-height: 120px;
        padding: 0.5rem;
        position: relative;
    }

    .calendar-day.other-month {
        background: #f9f9f9;
        opacity: 0.5;
    }

    .calendar-day.today {
        background: #fff3cd;
    }

    .day-number {
        font-weight: bold;
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .calendar-day.today .day-number {
        background: #667eea;
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .event-item {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.25rem 0.5rem;
        margin-bottom: 0.25rem;
        border-radius: 4px;
        font-size: 0.75rem;
        cursor: pointer;
        transition: transform 0.2s;
        text-decoration: none;
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .event-item:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
    }

    .event-time {
        font-size: 0.65rem;
        opacity: 0.9;
    }

    .sidebar {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .sidebar h3 {
        color: #667eea;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .upcoming-event {
        padding: 1rem;
        border-left: 4px solid #667eea;
        background: #f8f9fa;
        margin-bottom: 1rem;
        border-radius: 6px;
        transition: all 0.3s;
    }

    .upcoming-event:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .upcoming-event-title {
        font-weight: bold;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .upcoming-event-date {
        color: #666;
        font-size: 0.875rem;
    }

    .upcoming-event-location {
        color: #888;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .no-events {
        text-align: center;
        color: #999;
        padding: 2rem;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .calendar-day {
            min-height: 80px;
            padding: 0.25rem;
        }

        .event-item {
            font-size: 0.65rem;
            padding: 0.15rem 0.3rem;
        }

        .calendar-weekdays div {
            padding: 0.5rem;
            font-size: 0.8rem;
        }

        .day-number {
            font-size: 0.8rem;
        }
    }
</style>
@endpush

@section('content')
<div class="calendar-header">
    <div class="calendar-navigation">
        <a href="{{ route('eventos.index', ['year' => $currentDate->copy()->subMonth()->year, 'month' => $currentDate->copy()->subMonth()->month]) }}" 
           class="nav-btn">◀ Anterior</a>
        
        <h2>{{ $currentDate->locale('es')->translatedFormat('F Y') }}</h2>
        
        <a href="{{ route('eventos.index', ['year' => $currentDate->copy()->addMonth()->year, 'month' => $currentDate->copy()->addMonth()->month]) }}" 
           class="nav-btn">Siguiente ▶</a>
    </div>
    
    <a href="{{ route('eventos.create') }}" class="btn btn-primary">+ Nuevo Evento</a>
</div>

<div class="calendar-grid">
    <div class="calendar-weekdays">
        <div>Lunes</div>
        <div>Martes</div>
        <div>Miércoles</div>
        <div>Jueves</div>
        <div>Viernes</div>
        <div>Sábado</div>
        <div>Domingo</div>
    </div>

    <div class="calendar-days">
        @php
            $startOfMonth = $currentDate->copy()->startOfMonth();
            $endOfMonth = $currentDate->copy()->endOfMonth();
            
            // Ajustar para que el lunes sea el primer día (1 = lunes, 7 = domingo)
            $dayOfWeek = $startOfMonth->dayOfWeekIso; // 1 (lunes) a 7 (domingo)
            
            // Días del mes anterior
            $daysFromPrevMonth = $dayOfWeek - 1;
            $startDate = $startOfMonth->copy()->subDays($daysFromPrevMonth);
            
            // Total de celdas a mostrar (6 semanas completas)
            $totalCells = 42;
            
            $currentDay = $startDate->copy();
            $today = now();
        @endphp

        @for ($i = 0; $i < $totalCells; $i++)
            @php
                $isCurrentMonth = $currentDay->month == $currentDate->month;
                $isToday = $currentDay->isSameDay($today);
                $dayNumber = $currentDay->day;
                $dayEvents = isset($eventosPorDia[$dayNumber]) && $isCurrentMonth ? $eventosPorDia[$dayNumber] : [];
            @endphp

            <div class="calendar-day {{ !$isCurrentMonth ? 'other-month' : '' }} {{ $isToday ? 'today' : '' }}">
                <div class="day-number">{{ $dayNumber }}</div>
                
                @foreach ($dayEvents as $evento)
                    <a href="{{ route('eventos.show', $evento) }}" class="event-item" title="{{ $evento->nombre_evento }}">
                        <div class="event-time">{{ $evento->fecha_inicio->format('H:i') }}</div>
                        {{ Str::limit($evento->nombre_evento, 20) }}
                    </a>
                @endforeach
            </div>

            @php
                $currentDay->addDay();
            @endphp
        @endfor
    </div>
</div>

<!-- Próximos eventos -->
<div class="sidebar">
    <h3>📌 Próximos Eventos</h3>
    
    @if($proximosEventos->count() > 0)
        @foreach($proximosEventos as $evento)
            <div class="upcoming-event">
                <div class="upcoming-event-title">{{ $evento->nombre_evento }}</div>
                <div class="upcoming-event-date">
                    📅 {{ $evento->fecha_inicio->locale('es')->translatedFormat('l, d \d\e F \d\e Y - H:i') }}
                </div>
                @if($evento->ubicacion)
                    <div class="upcoming-event-location">
                        📍 {{ $evento->ubicacion }}
                    </div>
                @endif
                <div style="margin-top: 0.5rem;">
                    <a href="{{ route('eventos.show', $evento) }}" class="btn btn-sm btn-primary">Ver detalles</a>
                </div>
            </div>
        @endforeach
    @else
        <div class="no-events">No hay próximos eventos programados</div>
    @endif
</div>
@endsection
