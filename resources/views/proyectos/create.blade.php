<!DOCTYPE html>
<html>
<head>
    <title>Agregar Proyecto</title>
</head>
<body>
<h1>Agregar Nuevo Proyecto</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('proyectos.store')}}" method="POST">
    @csrf

    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
    </div>

    <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
    </div>

    <div>
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
    </div>

    <div>
        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}" required>
    </div>

    <div>
        <label for="presupuesto">Presupuesto:</label>
        <input type="number" name="presupuesto" id="presupuesto" value="{{ old('presupuesto') }}" required>
    </div>

    <button type="submit">Crear Proyecto</button>
    <a href="{{ route('proyectos.index') }}">Cancelar</a>
</form>
</body>
</html>
