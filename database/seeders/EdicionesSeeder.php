<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EdicionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ediciones')->truncate();
        foreach (self::$ediciones as $edicion) {
            \App\Models\Edicion::create([
                'curso_escolar' => $edicion['curso_escolar'],
                'fecha_celebracion' => $edicion['fecha_celebracion'],
                'fecha_apertura' => $edicion['fecha_apertura'],
                'fecha_cierre' => $edicion['fecha_cierre']
            ]);
        }
    }

    private static $ediciones = array(
        array('curso_escolar' => '21/22', 'fecha_celebracion' => '2023-01-01', 'fecha_apertura' => '2023-12-31','fecha_cierre' => '2024-01-15'),
        array('curso_escolar' => '22/23', 'fecha_celebracion' => '2023-01-01', 'fecha_apertura' => '2023-12-31','fecha_cierre' => '2024-01-15'),
        array('curso_escolar' => '23/24', 'fecha_celebracion' => '2023-01-01', 'fecha_apertura' => '2023-12-31','fecha_cierre' => '2024-01-15'),
        array('curso_escolar' => '24/25', 'fecha_celebracion' => '2023-01-01', 'fecha_apertura' => '2023-12-31','fecha_cierre' => '2024-01-15'),
    );
}
