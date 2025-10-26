<!DOCTYPE html>
<html>
<head>
    <title>Agregar Contacto</title>
</head>
<body>
<h1>Agregar Nuevo Contacto</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('contactos.store')}}" method="POST">
    @csrf

    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
    </div>

    <div>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}">
    </div>

    <div>
        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}">
    </div>

    <button type="submit">Crear Contacto</button>
    <a href="{{ route('contactos.index') }}">Cancelar</a>
</form>
</body>
</html>