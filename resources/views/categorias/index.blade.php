<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
        .badge-active { background-color: #10B981; color: white; }
        .badge-inactive { background-color: #EF4444; color: white; }
        .color-box { display: inline-block; width: 30px; height: 30px; border-radius: 4px; border: 1px solid #ddd; }
        .icono { font-size: 24px; }
        .categoria-principal { font-weight: bold; }
        .subcategoria { padding-left: 20px; color: #666; }
        .alert-success { padding: 10px; margin: 10px 0; background: #d4edda; border: 1px solid #c3e6cb; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; }
        .btn-primary { background: #3B82F6; color: white; }
        .btn-warning { background: #F59E0B; color: white; }
        .btn-danger { background: #EF4444; color: white; display: inline; }
    </style>
</head>
<body>
<h1>Lista de Categorías</h1>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div style="margin-bottom: 20px;">
    <a href="{{route('categorias.create')}}" class="btn btn-primary">+ Crear Nueva Categoría</a>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Orden</th>
        <th>Icono</th>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Color</th>
        <th>Descripción</th>
        <th>Tipo</th>
        <th>Productos</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @forelse($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->orden }}</td>
            <td class="icono">{{ $categoria->icono ?? '📦' }}</td>
            <td class="{{ $categoria->categoria_padre_id ? 'subcategoria' : 'categoria-principal' }}">
                {{ $categoria->nombre }}
            </td>
            <td><code>{{ $categoria->slug }}</code></td>
            <td>
                <span class="color-box" style="background-color: {{ $categoria->color }}"></span>
                {{ $categoria->color }}
            </td>
            <td>{{ Str::limit($categoria->descripcion, 50) ?? 'Sin descripción' }}</td>
            <td>
                @if($categoria->categoria_padre_id)
                    <small>Subcategoría de: {{ $categoria->categoriaPadre->nombre ?? 'N/A' }}</small>
                @else
                    Principal
                @endif
            </td>
            <td>{{ $categoria->cantidad_productos }}</td>
            <td>
                <span class="badge {{ $categoria->activo ? 'badge-active' : 'badge-inactive' }}">
                    {{ $categoria->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </td>
            <td>
                <a href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-primary">Ver</a>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11" style="text-align: center;">No hay categorías encontradas</td>
        </tr>
    @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    <p><strong>Total de categorías:</strong> {{ $categorias->count() }}</p>
</div>
</body>
</html>
