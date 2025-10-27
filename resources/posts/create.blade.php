@extends('layouts.app')

@section('title', 'Crear Post')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Crear Nuevo Post</h2>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Crear Post</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
