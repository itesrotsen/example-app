@extends('layouts.app')

@section('title', 'Editar Post')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Editar Post</h2>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Actualizar Post</button>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
