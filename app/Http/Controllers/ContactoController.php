<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Http\Requests\ValidateContactoRequest;
use App\Http\Requests\UpdateContactoRequest;
use Illuminate\Contracts\View\View;

class ContactoController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|View
    {
        $contactos = Contacto::all();
        return view('contactos.contacto')->with(['contactos' => $contactos]);
    }

    public function create()
    {
        return view('contactos.agregar');
    }

    public function store(ValidateContactoRequest $request)
    {
        $contactoData = $request->validated();
        $contacto = new Contacto();
        $contacto->fill($contactoData);
        $contacto->save();
        return redirect()->route('contactos.index');
    }

    public function edit(Contacto $contacto)
    {
        return view('contactos.editar')->with(['contacto' => $contacto]);
    }

    public function update(UpdateContactoRequest $request, Contacto $contacto)
    {
        $contactoData = $request->validated();
        $contacto->fill($contactoData);
        $contacto->save();
        return redirect()->route('contactos.index');
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return redirect()->route('contactos.index');
    }
}