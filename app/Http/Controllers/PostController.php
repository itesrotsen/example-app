<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Usar el primer usuario disponible si no hay autenticación
        $user = Auth::user() ?? \App\Models\User::first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'No hay usuarios en el sistema.');
        }

        $post = $user->posts()->create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'rootComments.user', 'rootComments.replies.user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $userId = Auth::id() ?? \App\Models\User::first()?->id;
        
        if ($post->user_id !== $userId) {
            abort(403, 'No autorizado');
        }
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $userId = Auth::id() ?? \App\Models\User::first()?->id;
        
        if ($post->user_id !== $userId) {
            abort(403, 'No autorizado');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $userId = Auth::id() ?? \App\Models\User::first()?->id;
        
        if ($post->user_id !== $userId) {
            abort(403, 'No autorizado');
        }
        
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post eliminado exitosamente.');
    }
}
