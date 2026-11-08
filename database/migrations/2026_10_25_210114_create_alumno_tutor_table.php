<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumno_tutor', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('tutores')->onDelete('cascade');
            
            // Tipo de relación
            $table->enum('tipo_relacion', ['Padre', 'Madre', 'Tutor'])->default('Tutor');
            
            // ¿Es el responsable principal?
            $table->boolean('es_responsable')->default(false);
            
            // ¿Vive con el alumno?
            $table->boolean('vive_con_alumno')->default(true);
            
            $table->timestamps();
            
            // Evitar duplicados
            $table->unique(['alumno_id', 'tutor_id', 'tipo_relacion']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumno_tutor');
    }
};
