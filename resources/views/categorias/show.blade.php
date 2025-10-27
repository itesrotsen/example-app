<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Categoría</title>
    <style>
        .container { max-width: 800px; margin: 20px auto; padding: 20px; }
        .header { border-bottom: 2px solid #ddd; padding-bottom: 15px; margin-bottom: 20px; }
        .detail-row { display: flex; margin-bottom: 15px; }
        .detail-label { font-weight: bold; width: 200px; }
        .detail-value { flex: 1; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 14px; }
        .badge-active { background-color: #10B981; color: white; }
        .badge-inactive { background-color: #EF4444; color: white; }
        .color-preview { display: inline-block; width: 50px; height: 50px; border-radius: 4px; border: 2px solid #ddd; vertical-align: middle; }
        .icono-preview { font-size: 48px; }
        .actions { margin-top: 30px; padding-top: 20px; border-top: 2px solid #ddd; }
        .btn { padding: 10px 20px; margin-right: 10px; text-decoration: none; display: inline-block; border-radius: 4px; }
        .btn-primary { background: #3B82F6; color: white; }
        .btn-warning { background: #F59E0B; color: white; }
        .btn-danger { background: #EF4444; color: white; border: none; cursor: pointer; }
        .btn-secondary { background: #6B7280; color: white; }
        .subcategorias { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $categoria->icono }} {{ $categoria->nombre }}</h1>
    </div>

    <div class="detail-row">
        <div class="detail-label">ID:</div>
        <div class="detail-value">{{ $categoria->id }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Slug:</div>
        <div class="detail-value"><code>{{ $categoria->slug }}</code></div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Descripción:</div>
        <div class="detail-value">{{ $categoria->descripcion ?? 'Sin descripción' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Icono:</div>
        <div class="detail-value">
            <span class="icono-preview">{{ $categoria->icono ?? '📦' }}</span>
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Color:</div>
        <div class="detail-value">
            <span class="color-preview" style="background-color: {{ $categoria->color }}"></span>
            {{ $categoria->color }}
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Orden:</div>
        <div class="detail-value">{{ $categoria->orden }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Tipo:</div>
        <div class="detail-value">
            @if($categoria->categoria_padre_id)
                <strong>Subcategoría de:</strong> {{ $categoria->categoriaPadre->nombre ?? 'N/A' }}
            @else
                Categoría Principal
            @endif
        </div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Cantidad de Productos:</div>
        <div class="detail-value">{{ $categoria->cantidad_productos }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Estado:</div>
        <div class="detail-value">
            <span class="badge {{ $categoria->activo ? 'badge-active' : 'badge-inactive' }}">
                {{ $categoria->activo ? 'Activo' : 'Inactivo' }}
            </span>
        </div>
    </div>

    @if($categoria->subcategorias && $categoria->subcategorias->count() > 0)
    <div class="subcategorias">
        <h3>Subcategorías ({{ $categoria->subcategorias->count() }})</h3>
        <ul>
            @foreach($categoria->subcategorias as $sub)
                <li>
                    {{ $sub->icono }} {{ $sub->nombre }}
                    <span class="badge {{ $sub->activo ? 'badge-active' : 'badge-inactive' }}">
                        {{ $sub->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="detail-row">
        <div class="detail-label">Fecha de creación:</div>
        <div class="detail-value">{{ $categoria->created_at->format('d/m/Y H:i') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Última actualización:</div>
        <div class="detail-value">{{ $categoria->updated_at->format('d/m/Y H:i') }}</div>
    </div>

    <div class="actions">
        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning">✏️ Editar</a>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">← Volver al listado</a>
        
        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?\n\nEsto también afectará a sus subcategorías.')">🗑️ Eliminar</button>
        </form>
    </div>
</div>
</body>
</html>