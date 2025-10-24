<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|View
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index')->with(['proyectos' => $proyectos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request)
    {
        $proyectoData = $request->validated();
        $proyecto = new Proyecto();
        $proyecto->fill($proyectoData);
        $proyecto->save();
        return redirect()->route('proyectos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show')->with(['proyecto' => $proyecto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit')->with(['proyecto' => $proyecto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto)
    {
        $proyectoData = $request->validated();
        $proyecto->fill($proyectoData);
        $proyecto->save();
        return redirect()->route('proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index');
    }
}
