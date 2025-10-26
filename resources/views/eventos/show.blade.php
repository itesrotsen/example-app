@extends('layouts.app')

@section('title', $evento->nombre_evento)

@push('styles')
<style>
    .event-detail-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .event-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
    }

    .event-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .event-status {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-upcoming {
        background: #28a745;
        color: white;
    }

    .status-ongoing {
        background: #ffc107;
        color: #000;
    }

    .status-past {
        background: #6c757d;
        color: white;
    }

    .event-body {
        padding: 2rem;
    }

    .event-info-grid {
        display: grid;
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    .info-icon {
        font-size: 1.5rem;
        min-width: 30px;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-weight: 600;
        color: #667eea;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        color: #333;
        font-size: 1.1rem;
    }

    .event-description {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin: 1.5rem 0;
        line-height: 1.8;
        color: #555;
    }

    .event-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        padding: 1.5rem 2rem;
        background: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .delete-form {
        display: inline;
    }

    @media (max-width: 768px) {
        .event-title {
            font-size: 1.5rem;
        }

        .event-actions {
            flex-direction: column;
        }

        .event-actions .btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="event-detail-card">
    <div class="event-header">
        <div class="event-title">{{ $evento->nombre_evento }}</div>
        
        @php
            $now = now();
            $isUpcoming = $evento->fecha_inicio > $now;
            $isOngoing = $evento->enCurso();
            $isPast = !$isUpcoming && !$isOngoing;
        @endphp

        @if($isOngoing)
            <span class="event-status status-ongoing">🔴 En curso</span>
        @elseif($isUpcoming)
            <span class="event-status status-upcoming">📅 Próximamente</span>
        @else
            <span class="event-status status-past">✓ Finalizado</span>
        @endif
    </div>

    <div class="event-body">
        <div class="event-info-grid">
            <div class="info-item">
                <div class="info-icon">📅</div>
                <div class="info-content">
                    <div class="info-label">Fecha y Hora de Inicio</div>
                    <div class="info-value">
                        {{ $evento->fecha_inicio->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}
                        <br>
                        <strong>{{ $evento->fecha_inicio->format('H:i') }} hrs</strong>
                    </div>
                </div>
            </div>

            @if($evento->fecha_fin)
                <div class="info-item">
                    <div class="info-icon">🏁</div>
                    <div class="info-content">
                        <div class="info-label">Fecha y Hora de Finalización</div>
                        <div class="info-value">
                            {{ $evento->fecha_fin->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}
                            <br>
                            <strong>{{ $evento->fecha_fin->format('H:i') }} hrs</strong>
                        </div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">⏱️</div>
                    <div class="info-content">
                        <div class="info-label">Duración</div>
                        <div class="info-value">
                            @php
                                $duracionHoras = $evento->duracion;
                                $horas = floor($duracionHoras);
                                $minutos = ($duracionHoras - $horas) * 60;
                            @endphp
                            
                            @if($horas > 0)
                                {{ $horas }} {{ $horas == 1 ? 'hora' : 'horas' }}
                            @endif
                            
                            @if($minutos > 0)
                                {{ round($minutos) }} minutos
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($evento->ubicacion)
                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <div class="info-label">Ubicación</div>
                        <div class="info-value">{{ $evento->ubicacion }}</div>
                    </div>
                </div>
            @endif

            <div class="info-item">
                <div class="info-icon">🕐</div>
                <div class="info-content">
                    <div class="info-label">Creado</div>
                    <div class="info-value">{{ $evento->created_at->locale('es')->diffForHumans() }}</div>
                </div>
            </div>

            @if($evento->updated_at != $evento->created_at)
                <div class="info-item">
                    <div class="info-icon">✏️</div>
                    <div class="info-content">
                        <div class="info-label">Última Actualización</div>
                        <div class="info-value">{{ $evento->updated_at->locale('es')->diffForHumans() }}</div>
                    </div>
                </div>
            @endif
        </div>

        @if($evento->descripcion)
            <div class="event-description">
                <div class="info-label" style="margin-bottom: 0.5rem;">📝 Descripción</div>
                <div style="white-space: pre-line;">{{ $evento->descripcion }}</div>
            </div>
        @endif
    </div>

    <div class="event-actions">
        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
            ← Volver al Calendario
        </a>
        
        <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-primary">
            ✏️ Editar Evento
        </a>

        <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="delete-form" 
              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                🗑️ Eliminar Evento
            </button>
        </form>
    </div>
</div>
@endsection
