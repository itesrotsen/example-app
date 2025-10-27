<div class="comment {{ isset($isReply) && $isReply ? 'comment-reply' : '' }}">
    <div class="comment-header">
        <div>
            <span class="comment-author">{{ $comment->user->name ?? 'Usuario' }}</span>
            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="comment-content">
        {{ $comment->content }}
    </div>

    <div class="comment-actions">
        <button onclick="toggleReplyForm({{ $comment->id }})" class="btn btn-primary">Responder</button>
        
        <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
        </form>
    </div>

    <!-- Reply Form -->
    <div id="reply-form-{{ $comment->id }}" class="reply-form">
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Escribe tu respuesta..." required></textarea>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn btn-success">Publicar Respuesta</button>
                <button type="button" onclick="toggleReplyForm({{ $comment->id }})" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>

    <!-- Nested Replies -->
    @if($comment->replies->count() > 0)
        <div style="margin-top: 1rem;">
            @foreach($comment->replies as $reply)
                @include('posts.partials.comment', ['comment' => $reply, 'post' => $post, 'isReply' => true])
            @endforeach
        </div>
    @endif
</div>
