<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            
            // Relación polimórfica (puede ser un Alumno, un Personal o la Escuela)
            $table->nullableMorphs('entidad'); 
            
            // Datos de la bitácora
            $table->string('categoria'); // conducta, felicitacion, logro, etc.
            $table->text('descripcion');
            $table->string('archivo_evidencia')->nullable(); // Para fotos o PDFs
            $table->boolean('notificar_padres')->default(false); // Para el tablón
            
            // Quién lo registró
            $table->foreignId('user_id')->nullable()->constrained(); 
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
