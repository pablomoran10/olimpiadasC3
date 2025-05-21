<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Edicion;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function edicionId($id)
    {
        $edicion = session(['edicion_id' => $id]);
        return redirect()->route('ediciones.categorias.index', ['edicion' => $edicion]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Edicion $edicion)
    {
        // $categorias = Categoria::all();
        // return view('admin.categorias.index', compact('categorias'));
        $categorias = $edicion->categorias;
        return view('admin.categorias.index', compact('categorias', 'edicion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Edicion $edicion)
    {
        $categoria = new Categoria;
        return view('admin.categorias.create', compact('categoria', 'edicion'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Edicion $edicion, Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria', 'edicion'));
    }

    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }

    public function store(Request $request, Edicion $edicion)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        // Asignar la categoria a la edicion
        $edicion->categorias()->attach($categoria);

        return redirect()->route('ediciones.categorias.index', ['edicion' => $edicion])->with('success', 'Categoria creada correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        $edicion = $categoria->ediciones->first();

        return redirect()->route('ediciones.categorias.index', ['edicion' => $edicion])
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
{
    $edicion = $categoria->ediciones->first();

    $categoria->ediciones()->detach();

    $categoria->delete();

    return redirect()->route('ediciones.categorias.index', $edicion)->with('success', 'Categoría eliminada correctamente.');
}

}
