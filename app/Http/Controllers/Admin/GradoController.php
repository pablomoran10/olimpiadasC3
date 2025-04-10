<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::all();
        return view('admin.grados.index', compact('grados'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.grados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        Grado::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('grados.index')->with('success', 'Grado creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Grado $grado)
    {
        return view('admin.grados.edit', compact('grado'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Grado $grado){
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $grado->nombre = $request->nombre;
        $grado->save();

        return redirect()->route('grados.index')->with('success', 'Grado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Grado $grado)
    {
        $grado->delete();
        return redirect()->route('grados.index')->with('success', 'Grado eliminado correctamente.');
    }

}