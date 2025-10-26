@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
<div class="card">
    <div class="card-header">
        ✏️ Editar Evento
    </div>

    <form action="{{ route('eventos.update', $evento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre_evento" class="form-label">Nombre del Evento *</label>
            <input type="text" 
                   name="nombre_evento" 
                   id="nombre_evento" 
                   class="form-control @error('nombre_evento') is-invalid @enderror" 
                   value="{{ old('nombre_evento', $evento->nombre_evento) }}"
                   placeholder="Ej: Reunión de equipo, Conferencia, Cumpleaños..."
                   required>
            @error('nombre_evento')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" 
                      id="descripcion" 
                      class="form-control @error('descripcion') is-invalid @enderror"
                      rows="4"
                      placeholder="Describe los detalles del evento...">{{ old('descripcion', $evento->descripcion) }}</textarea>
            @error('descripcion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha_inicio" class="form-label">Fecha y Hora de Inicio *</label>
            <input type="datetime-local" 
                   name="fecha_inicio" 
                   id="fecha_inicio" 
                   class="form-control @error('fecha_inicio') is-invalid @enderror" 
                   value="{{ old('fecha_inicio', $evento->fecha_inicio->format('Y-m-d\TH:i')) }}"
                   required>
            @error('fecha_inicio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha_fin" class="form-label">Fecha y Hora de Finalización</label>
            <input type="datetime-local" 
                   name="fecha_fin" 
                   id="fecha_fin" 
                   class="form-control @error('fecha_fin') is-invalid @enderror" 
                   value="{{ old('fecha_fin', $evento->fecha_fin ? $evento->fecha_fin->format('Y-m-d\TH:i') : '') }}">
            @error('fecha_fin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small style="color: #666; font-size: 0.875rem;">Opcional: deja vacío si es un evento de todo el día</small>
        </div>

        <div class="form-group">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" 
                   name="ubicacion" 
                   id="ubicacion" 
                   class="form-control @error('ubicacion') is-invalid @enderror" 
                   value="{{ old('ubicacion', $evento->ubicacion) }}"
                   placeholder="Ej: Sala de conferencias, Zoom, Dirección física...">
            @error('ubicacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-success">💾 Actualizar Evento</button>
            <a href="{{ route('eventos.show', $evento) }}" class="btn btn-secondary">← Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaInicio = document.getElementById('fecha_inicio');
        const fechaFin = document.getElementById('fecha_fin');
        
        // Cuando se cambia la fecha de inicio, actualizar la fecha de fin automáticamente
        fechaInicio.addEventListener('change', function() {
            if (!fechaFin.value && fechaInicio.value) {
                const inicio = new Date(fechaInicio.value);
                inicio.setHours(inicio.getHours() + 1);
                
                const year = inicio.getFullYear();
                const month = String(inicio.getMonth() + 1).padStart(2, '0');
                const day = String(inicio.getDate()).padStart(2, '0');
                const hours = String(inicio.getHours()).padStart(2, '0');
                const minutes = String(inicio.getMinutes()).padStart(2, '0');
                
                fechaFin.value = `${year}-${month}-${day}T${hours}:${minutes}`;
            }
        });
    });
</script>
@endpush
@endsection
