<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            
            // Datos personales
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('curp', 18)->unique();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('lugar_trabajo')->nullable();
            
            // Datos adicionales
            $table->text('observaciones')->nullable();
            
            // Auditoría
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
