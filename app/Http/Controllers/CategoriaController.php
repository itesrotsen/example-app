<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;

class CategoriaController extends Controller
{
    private $categoriaRepository;
    private $categoryService;

    public function __construct(CategoryService    $categoryService,
                                CategoryRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
        $this->categoryService = $categoryService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|View
    {
        // Obtener todas las categorías ordenadas
        $categorias = $this->categoryService->allByMainCategory();
        return view('categorias.index')->with(['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener solo categorías principales para el select de categoría padre
        $categorias = $this->categoriaRepository->principalCategories();
        return view('categorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        $categoriaData = $request->validated();
        if ($this->categoryService->store($categoriaData)) {
            return redirect()
                ->route('categorias.index')
                ->with('success', 'Categoría creada exitosamente.');
        }
        return back()->withErrors($this->categoryService->bagErrors);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        // Cargar relaciones
        $categoria->load(['categoriaPadre', 'subcategorias']);

        return view('categorias.show')->with(['categoria' => $categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        // Obtener categorías para el select, excluyendo la actual y sus subcategorías
        $categorias = Categoria::where('id', '!=', $categoria->id)
            ->whereNull('categoria_padre_id')
            ->activas()
            ->ordenadas()
            ->get();

        return view('categorias.edit', compact('categoria', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoriaData = $request->validated();

        // Actualizar la categoría
        $categoria->fill($categoriaData);
        $categoria->save();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        // Verificar si tiene subcategorías
        if ($categoria->subcategorias()->count() > 0) {
            return redirect()
                ->route('categorias.index')
                ->with('error', 'No se puede eliminar una categoría que tiene subcategorías.');
        }

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }
}
