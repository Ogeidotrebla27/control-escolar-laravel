<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            
            // Datos de la escuela
            $table->string('nombre_escuela');
            $table->string('clave_centro_trabajo', 20)->nullable();
            $table->string('zona_escolar', 20)->nullable();
            $table->string('sector_educativo', 20)->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('lema')->nullable();
            
            // Autoridades
            $table->string('director_nombre')->nullable();
            $table->string('director_cedula')->nullable();
            $table->string('supervisor_nombre')->nullable();
            $table->string('jefe_sector_nombre')->nullable();
            $table->string('crede_oficina')->nullable();
            
            // Ciclo escolar
            $table->string('ciclo_actual', 20)->nullable();
            $table->date('ciclo_inicio')->nullable();
            $table->date('ciclo_fin')->nullable();
            
            // Configuración del sistema
            $table->string('formato_fecha', 20)->default('d/m/Y');
            $table->string('moneda', 10)->default('MXN');
            
            // Remitente para documentos
            $table->string('remitente_nombre')->nullable();
            $table->string('remitente_cargo')->nullable();
            
            // Firmas y sellos (imágenes)
            $table->string('firma_director')->nullable();
            $table->string('sello_escuela')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};
