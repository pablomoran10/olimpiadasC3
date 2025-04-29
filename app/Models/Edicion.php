<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    use HasFactory;

    protected $table = 'ediciones'; //nombre de la tabla de la base de datos en phpmyadmin me daba problemas y la he especificado

    protected $fillable = [
        'curso_escolar',
        'num_olimpiada',
        'num_modding',
        'num_videojuegos',
        'fecha_celebracion',
        'fecha_apertura',
        'fecha_cierre',
        'css_file'
    ];

    public static function getEdicionActual()
    {
        // Si la sesión ya tiene una edición, devolverla
        if (session()->has('edicion')) {
            return session('edicion');
        }

        // Obtener la edición más reciente por fecha de apertura
        return Edicion::orderBy('fecha_apertura', 'DESC')->first();
    }

    public function resultados()
    {
        return $this->hasOne(Resultado::class, 'id');
    }

}
