<!DOCTYPE html>
<html>
<head>
    <title>Proyectos</title>
</head>
<body>
<h1>Lista de Proyectos</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{route('proyectos.create')}}">Crear Nuevo Proyecto</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Fin</th>
        <th>Presupuesto</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @forelse($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id }}</td>
            <td>{{ $proyecto->nombre }}</td>
            <td>{{ $proyecto->descripcion }}</td>
            <td>{{ $proyecto->fecha_inicio }}</td>
            <td>{{ $proyecto->fecha_fin }}</td>
            <td>{{ $proyecto->presupuesto }}</td>
            <td>
                <a href="#">Ver</a>
                <a href="{{ route('proyectos.edit', $proyecto->id) }}">Editar</a>
                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7">No hay proyectos encontrados</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>