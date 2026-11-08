<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tutor;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;

class DatosPruebaSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos las tablas para evitar duplicados si lo corres varias veces
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('alumno_tutor')->truncate();
        Alumno::truncate();
        Tutor::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create('es_MX'); // Faker en español

        // 1. Creamos 3 tutores que tienen VARIOS hijos (para probar que no se dupliquen)
        for ($i = 1; $i <= 3; $i++) {
            $tutor = Tutor::create([
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName . ' ' . $faker->lastName,
                'curp' => strtoupper($faker->bothify('????######??????##')),
                'telefono' => $faker->numerify('834#######'),
                'email' => $faker->unique()->safeEmail,
            ]);

            // Le creamos 2 hijos: uno en 1° y otro en 6° (para probar la lógica del listado general)
            $this->crearAlumno($tutor, '1', 'A', 'Regular');
            $this->crearAlumno($tutor, '6', 'A', 'Regular');
        }

        // 2. Creamos 2 tutores con un solo hijo (uno regular y uno irregular)
        for ($i = 1; $i <= 2; $i++) {
            $tutor = Tutor::create([
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName . ' ' . $faker->lastName,
                'curp' => strtoupper($faker->bothify('????######??????##')),
                'telefono' => $faker->numerify('834#######'),
                'email' => $faker->unique()->safeEmail,
            ]);

            $estatus = ($i == 1) ? 'Regular' : 'Irregular';
            $this->crearAlumno($tutor, '3', 'B', $estatus);
        }

        // 3. Creamos algunos alumnos "sueltos" en otros grupos
        for ($i = 1; $i <= 5; $i++) {
            $tutor = Tutor::create([
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName . ' ' . $faker->lastName,
                'curp' => strtoupper($faker->bothify('????######??????##')),
                'telefono' => $faker->numerify('834#######'),
                'email' => $faker->unique()->safeEmail,
            ]);
            $this->crearAlumno($tutor, '4', 'C', 'Regular');
        }

        $this->command->info('✅ Datos de prueba generados correctamente.');
    }

    // Función auxiliar para crear al alumno y vincularlo al tutor
    private function crearAlumno($tutor, $grado, $grupo, $estatus)
    {
        $faker = \Faker\Factory::create('es_MX');
        
        $alumno = Alumno::create([
            'nombre' => $faker->firstName,
            'apellidos' => $faker->lastName . ' ' . $faker->lastName,
            'curp' => strtoupper($faker->bothify('????######??????##')),
            'matricula' => date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'fecha_nacimiento' => $faker->date('Y-m-d', '2015-01-01'),
            'grado' => $grado,
            'grupo' => $grupo,
            'turno' => 'Matutino',
            'fecha_inscripcion' => date('Y-m-d'),
            'estatus' => $estatus,
            'estatus_documentos' => 'Completo',
        ]);

        // Vinculamos al tutor como "Responsable"
        $alumno->tutores()->attach($tutor->id, [
            'tipo_relacion' => 'Tutor',
            'es_responsable' => 1,
            'vive_con_alumno' => 1,
        ]);
    }
}
