<!DOCTYPE html>
<html>
<head>
    <title>Contactos</title>
</head>
<body>
<h1>Directorio de Contactos</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{route('contactos.create')}}">Crear Nuevo Contacto</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Direccion</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @forelse($contactos as $contacto)
        <tr>
            <td>{{ $contacto->id }}</td>
            <td>{{ $contacto->nombre }}</td>
            <td>{{ $contacto->email }}</td>
            <td>{{ $contacto->telefono }}</td>
            <td>{{ $contacto->direccion }}</td>
            <td>
                <a href="{{ route('contactos.edit', $contacto->id) }}">Editar</a>
                <form action="{{ route('contactos.destroy', $contacto->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No hay contactos encontrados</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>