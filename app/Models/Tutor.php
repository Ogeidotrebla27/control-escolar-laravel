<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tutores';

    protected $fillable = [
        'nombre',
        'apellidos',
        'curp',
        'telefono',
        'email',
        'direccion',
        'ocupacion',
        'lugar_trabajo',
        'observaciones',
        'user_id',
    ];

    // ==========================================
    // RELACIONES
    // ==========================================
    
    /**
     * Alumnos del tutor (muchos a muchos)
     */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_tutor')
                    ->withPivot('tipo_relacion', 'es_responsable', 'vive_con_alumno')
                    ->withTimestamps();
    }

    /**
     * Alumnos de los que es responsable principal
     */
    public function alumnosResponsable()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_tutor')
                    ->wherePivot('es_responsable', true)
                    ->withPivot('tipo_relacion', 'es_responsable', 'vive_con_alumno')
                    ->withTimestamps();
    }

    /**
     * Usuario que registró al tutor
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ==========================================
    // ACCESORES
    // ==========================================
    
    /**
     * Nombre completo del tutor
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }
}
