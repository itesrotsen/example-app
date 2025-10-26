<!DOCTYPE html>
<html>
<head>
    <title>Editar Proyecto</title>
</head>
<body>
<h1>Editar Proyecto</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proyecto->nombre) }}" required>
    </div>

    <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
    </div>

    <div>
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}" required>
    </div>

    <div>
        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $proyecto->fecha_fin) }}" required>
    </div>

    <div>
        <label for="presupuesto">Presupuesto:</label>
        <input type="number" name="presupuesto" id="presupuesto" value="{{ old('presupuesto', $proyecto->presupuesto) }}" required>
    </div>

    <button type="submit">Actualizar Proyecto</button>
    <a href="{{ route('proyectos.index') }}">Cancelar</a>
</form>
</body>
</html>
