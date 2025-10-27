@extends('layouts.app')

@section('content')
<h1>Editar Producto</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('productos.update', $producto) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}">
    </div>
    <div>
        <label>Descripción:</label>
        <textarea name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
    </div>
    <div>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}">
    </div>
    <div>
        <label>Stock:</label>
        <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}">
    </div>
    <div>
        <label>Categoría:</label>
        <input type="text" name="categoria" value="{{ old('categoria', $producto->categoria) }}">
    </div>
    <div>
        <label>Imagen (URL):</label>
        <input type="text" name="imagen" value="{{ old('imagen', $producto->imagen) }}">
    </div>
    <button type="submit">Actualizar</button>
</form>

<a href="{{ route('productos.index') }}">Volver al listado</a>
@endsection
