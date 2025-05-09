<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InscripcionesController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize('store-inscripcion');

        // Documentación de la validación https://laravel.com/docs/10.x/validation#manually-creating-validators
        $validator = Validator::make($request->all(), [
            'centro' => 'required|numeric',
            'prof_resp' => 'required|string|max:255',
            'email_prof_resp' => 'required|email|max:255',
            'ciclo' => 'required|numeric',
            'categoria' => 'required|numeric',
            'grupo' => 'required|string|max:255|unique:grupos,nombre',
            'nombre.*' => 'nullable|string|max:255',
            'apellido.*' => 'nullable|string|max:255',
        ]);

        // Validación adicional https://laravel.com/docs/10.x/validation#performing-additional-validation
        $validator->after(function ($validator) {
            $validated = $validator->validated();
            $categoriasByGrado = [
                1 => [3, 4], // 'fp_basica'
                2 => [1, 2, 3, 4], // 'fp_grado_medio'
                3 => [2, 3, 4], // 'fp_grado_superior'
            ];
            $cicloSelected = Ciclo::find($validated['ciclo']);
            $categoriaSelected = $validated['categoria'];
            $gradoSelected = $cicloSelected->grado;
            if (!in_array($categoriaSelected, $categoriasByGrado[$gradoSelected->id])) {
                $validator->errors()->add(
                    'categoria', 'Los estudiantes del grado elegido no pueden inscribirse en la categoría seleccionada.'
                );
            }
            $alumnosMaximo = [0,3,3,10,7];
            // contar únicamente los nombres no null
            $alumnosEnviados = array_filter($validated['nombre'], function ($value) {
                return !is_null($value);
            });
            if (count($alumnosEnviados) > $alumnosMaximo[$categoriaSelected]) {
                $validator->errors()->add(
                    'alumnos', 'La categoría seleccionada no admite más de ' . $alumnosMaximo[$categoriaSelected] . ' estudiantes.'
                );
            }
        });

        if ($validator->fails()) {
            return redirect(route('home'))
                        ->withErrors($validator)
                        ->withInput();
        }

        // Generar un usuario para el tutor
        $user = \App\Models\User::where('email', $request->email_prof_resp)->first();
        if (!$user) {
            $password = Str::random(10);
            $user = \App\Models\User::create([
                'name' => $request->prof_resp,
                'email' => $request->email_prof_resp,
                'password' => bcrypt($password),
            ]);
        }

        // Necesito obtener los 2 últimos dígitos del año en curso
        $year = date('y');
        // Crear la inscripción del grupo
        $grupo = \App\Models\Grupo::create([
            'nombre' => $request->grupo,
            'abreviatura' => strtolower(substr('O' . $year . "_" . Str::slug($request->grupo), 0, 20)),
            'password' => Str::random(9) . '*',
            'tutor' => $user->id,
            'centro_id' => $request->centro,
            'ciclo_id' => $request->ciclo,
            'categoria_id' => $request->categoria,
        ]);

        // Crear los participantes
        $alumnos = [];
        foreach ($request->nombre as $key => $nombre) {
            if ($nombre) {
                $alumnos[] = [
                    'nombre' => $nombre,
                    'apellidos' => $request->apellido[$key],
                    'grupo_id' => $grupo->id,
                ];
            }
        }
        \App\Models\Participante::insert($alumnos);
        // Enviar correo de confirmación al tutor
        $mensajeCorreo = "Recibirá un correo electrónico con la confirmación de la inscripción.";
        $mensajeCorreo .= "<br />Por favor, revise su bandeja de entrada y la carpeta de spam.";
        try {
            \Mail::to($user->email)->send(new \App\Mail\InscripcionConfirmada($request->all()));
        } catch (\Exception $e) {
            // Manejar el error de envío de correo
            $mensajeCorreo = "Error al enviar el correo de confirmación.<br />Por favor. Póngase en contacto con la organización.";
        }
        return redirect()->to(route('home') . '#inscripciones')->with('success', 'Inscripción realizada correctamente.<br />' . $mensajeCorreo);
    }
}
