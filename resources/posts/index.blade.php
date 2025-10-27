@extends('layouts.app')

@section('title', 'Todos los Posts')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Todos los Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Crear Nuevo Post</a>
</div>

@forelse($posts as $post)
    <div class="card">
        <h3 style="margin-bottom: 1rem;">
            <a href="{{ route('posts.show', $post) }}" style="color: #2c3e50; text-decoration: none;">
                {{ $post->title }}
            </a>
        </h3>
        <p style="color: #666; margin-bottom: 1rem;">
            {{ Str::limit($post->content, 200) }}
        </p>
        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.9rem; color: #999;">
            <span>Por: <strong>{{ $post->user->name ?? 'Usuario' }}</strong></span>
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>
@empty
    <div class="card">
        <p style="text-align: center; color: #999;">No hay posts todavía. ¡Crea el primero!</p>
    </div>
@endforelse

<div style="margin-top: 2rem;">
    {{ $posts->links() }}
</div>
@endsection
