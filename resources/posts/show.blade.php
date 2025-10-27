@extends('layouts.app')

@section('title', $post->title)

@section('content')
<style>
    .post-header {
        border-bottom: 2px solid #3498db;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .post-meta {
        color: #999;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .comments-section {
        margin-top: 3rem;
    }

    .comment {
        background-color: #f9f9f9;
        border-left: 3px solid #3498db;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 4px;
    }

    .comment-reply {
        margin-left: 2rem;
        border-left-color: #95a5a6;
        background-color: #fff;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .comment-author {
        font-weight: bold;
        color: #2c3e50;
    }

    .comment-date {
        color: #999;
        font-size: 0.85rem;
    }

    .comment-content {
        margin: 0.5rem 0;
        line-height: 1.6;
    }

    .comment-actions {
        margin-top: 0.5rem;
        display: flex;
        gap: 0.5rem;
    }

    .comment-actions button,
    .comment-actions a {
        font-size: 0.85rem;
        padding: 0.25rem 0.75rem;
    }

    .reply-form {
        margin-top: 1rem;
        padding: 1rem;
        background-color: #f0f0f0;
        border-radius: 4px;
        display: none;
    }

    .reply-form.active {
        display: block;
    }
</style>

<!-- Post Content -->
<div class="card">
    <div class="post-header">
        <h1>{{ $post->title }}</h1>
        <div class="post-meta">
            Por <strong>{{ $post->user->name ?? 'Usuario' }}</strong> · {{ $post->created_at->diffForHumans() }}
        </div>
    </div>

    <div style="white-space: pre-wrap;">{{ $post->content }}</div>

    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Editar</a>
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
        </form>
    </div>
</div>

<!-- Comments Section -->
<div class="comments-section">
    <h2 style="margin-bottom: 1.5rem;">Comentarios ({{ $post->comments->count() }})</h2>

    <!-- New Comment Form -->
    <div class="card">
        <h3 style="margin-bottom: 1rem;">Agregar Comentario</h3>
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="content" class="form-control" rows="4" placeholder="Escribe tu comentario..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Publicar Comentario</button>
        </form>
    </div>

    <!-- Comments List -->
    <div style="margin-top: 2rem;">
        @forelse($post->rootComments as $comment)
            @include('posts.partials.comment', ['comment' => $comment, 'post' => $post])
        @empty
            <div class="card">
                <p style="text-align: center; color: #999;">No hay comentarios todavía. ¡Sé el primero en comentar!</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById('reply-form-' + commentId);
        form.classList.toggle('active');
    }
</script>
@endsection
