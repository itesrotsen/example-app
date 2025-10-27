<!DOCTYPE html>
<html>
<head>
    <title>Agregar Categoría</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 8px; }
        input[type="color"] { width: 100px; height: 40px; }
        .alert { padding: 10px; margin: 10px 0; background: #f8d7da; border: 1px solid #f5c6cb; }
        .button-group { margin-top: 20px; }
        button { padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
<h1>Agregar Nueva Categoría</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('categorias.store')}}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nombre">Nombre: *</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
    </div>

    <div class="form-group">
        <label for="slug">Slug (URL amigable):</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Se genera automáticamente si se deja vacío">
        <small>Ejemplo: electronica-tecnologia</small>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="4">{{ old('descripcion') }}</textarea>
    </div>

    <div class="form-group">
        <label for="icono">Icono/Emoji:</label>
        <input type="text" name="icono" id="icono" value="{{ old('icono') }}" placeholder="📱 🏠 👕 ⚽">
        <small>Puedes usar emojis para representar la categoría</small>
    </div>

    <div class="form-group">
        <label for="color">Color (Hexadecimal):</label>
        <input type="color" name="color" id="color" value="{{ old('color', '#000000') }}">
        <input type="text" id="color_text" value="{{ old('color', '#000000') }}" readonly>
    </div>

    <div class="form-group">
        <label for="orden">Orden de visualización:</label>
        <input type="number" name="orden" id="orden" value="{{ old('orden', 0) }}" min="0">
        <small>Número para ordenar las categorías (menor número = más arriba)</small>
    </div>

    <div class="form-group">
        <label for="categoria_padre_id">Categoría Padre (para subcategorías):</label>
        <select name="categoria_padre_id" id="categoria_padre_id">
            <option value="">-- Ninguna (categoría principal) --</option>
            @if(isset($categorias))
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ old('categoria_padre_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="activo">
            <input type="checkbox" name="activo" id="activo" value="1" {{ old('activo', true) ? 'checked' : '' }}>
            Activo
        </label>
    </div>

    <div class="button-group">
        <button type="submit">Crear Categoría</button>
        <a href="{{ route('categorias.index') }}"><button type="button">Cancelar</button></a>
    </div>
</form>

<script>
    // Sincronizar color picker con texto
    const colorPicker = document.getElementById('color');
    const colorText = document.getElementById('color_text');
    
    colorPicker.addEventListener('input', function() {
        colorText.value = this.value;
    });
</script>
</body>
</html>
