<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Providers\MoodleServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{
    protected $moodleService;

    /**
     * Create the controller instance.
    */
    public function __construct(MoodleServiceProvider $moodleService)
    {
        $this->authorizeResource(Grupo::class, 'grupo');
        $this->moodleService = $moodleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Auth::user()->isAdmin() ? Grupo::all() : Grupo::where('tutor', Auth::id())->get();
        return view('admin.grupos.index', ['grupos' => $grupos]);
    }

    /**
     * Display one resource.
     */
    public function show(Grupo $grupo)
    {
        return view('admin.grupos.show', compact('grupo'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('admin.grupos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        Grupo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Grupo $grupo)
    {
        return view('admin.grupos.edit', compact('grupo'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Grupo $grupo){
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $grupo->nombre = $request->nombre;
        $grupo->save();

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente.');
    }

    public function crearUsuarioMoodle(Grupo $grupo)
    {
        $resultado = $this->moodleService->createUserFromGrupo($grupo);
        if (isset($resultado['error'])) {
            $error = 'Error al crear el usuario en Moodle: ' . $resultado['error'];
        }
            return redirect()->route('grupos.index')->with('error', $error);
    }

}
