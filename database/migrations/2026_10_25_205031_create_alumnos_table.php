<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            
            // Datos personales
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('curp', 18)->unique();
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento')->nullable();
            $table->enum('sexo', ['H', 'M'])->nullable();
            $table->string('nacionalidad')->default('Mexicana');
            
            // Datos escolares
            $table->string('matricula')->unique()->nullable();
            $table->string('grado', 10);
            $table->string('grupo', 10);
            $table->string('turno', 20)->default('Matutino');
            $table->date('fecha_inscripcion');
            $table->string('tipo_inscripcion')->default('Nuevo ingreso');
            $table->enum('estatus', ['Regular', 'Irregular'])->default('Regular');
            
            // Documentación
            $table->string('pdf_documentos')->nullable();
            $table->enum('estatus_documentos', ['Completo', 'Incompleto'])->default('Incompleto');
            
            // Datos médicos
            $table->text('alergias')->nullable();
            $table->text('enfermedades_cronicas')->nullable();
            $table->text('medicamentos')->nullable();
            $table->string('seguro_medico')->nullable();
            
            // Contacto de emergencia (persona externa)
            $table->string('contacto_emergencia_nombre')->nullable();
            $table->string('contacto_emergencia_telefono')->nullable();
            
            // Observaciones
            $table->text('observaciones')->nullable();
            
            // Multimedia
            $table->string('foto')->nullable();
            
            // Auditoría
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
