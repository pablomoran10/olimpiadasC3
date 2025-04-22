<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->truncate();
        foreach (self::$categorias as $categoria) {
            \App\Models\Categoria::create([
                'id' => $categoria['id'],
                'nombre' => $categoria['nombre'],
            ]);
        }
    }

    private static $categorias = array(
        array('id' => 1, 'nombre' => 'Grado Medio - XV Olimpiada Informática'),
        array('id' => 2, 'nombre' => 'Grado Superior - XV Olimpiada Informática'),
        array('id' => 3, 'nombre' => 'XIX Concurso Regional de Modding'),
        array('id' => 4, 'nombre' => 'II Concurso Regional de C3Gamer'),
    );
}
