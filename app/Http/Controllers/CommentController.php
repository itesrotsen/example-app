<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Usar el primer usuario disponible si no hay autenticación
        $userId = Auth::id() ?? \App\Models\User::first()?->id;
        
        if (!$userId) {
            return redirect()->back()->with('error', 'No hay usuarios en el sistema.');
        }

        $comment = $post->comments()->create([
            'user_id' => $userId,
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comentario agregado exitosamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $userId = Auth::id() ?? \App\Models\User::first()?->id;
        
        if ($comment->user_id !== $userId) {
            abort(403, 'No autorizado');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->route('posts.show', $comment->post)
            ->with('success', 'Comentario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $userId = Auth::id() ?? \App\Models\User::first()?->id;
        
        if ($comment->user_id !== $userId) {
            abort(403, 'No autorizado');
        }

        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comentario eliminado exitosamente.');
    }
}
