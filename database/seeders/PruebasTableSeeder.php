<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PruebasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias_ediciones')->truncate();
        DB::table('patrocinadores')->truncate();
        DB::table('pruebas')->truncate();

        foreach (self::$pruebas as $prueba) {
            DB::table('pruebas')->insert([
                'categorias_ediciones_id' => $prueba['categoria'],
                'nombre' => $prueba['nombre'],
            ]);
        }
        $this->command->info('¡Tablas categorias_ediciones, patrocinadores y pruebas inicializada con datos!');
    }

    private static $pruebas = array(
        array('categoria' => '1','patrocinador' => 'PRUEBA','nombre' => 'Prueba'),
    );
}
