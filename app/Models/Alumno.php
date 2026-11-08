<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alumnos';

    protected $fillable = [
        // Datos personales
        'nombre',
        'apellidos',
        'curp',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'sexo',
        'nacionalidad',
        
        // Datos escolares
        'matricula',
        'grado',
        'grupo',
        'turno',
        'fecha_inscripcion',
        'tipo_inscripcion',
        'estatus',
        
        // Documentación
        'pdf_documentos',
        'estatus_documentos',
        
        // Datos médicos
        'alergias',
        'enfermedades_cronicas',
        'medicamentos',
        'seguro_medico',
        
        // Contacto de emergencia
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
        
        // Observaciones
        'observaciones',
        
        // Multimedia
        'foto',
        
        // Auditoría
        'user_id',
    ];

    // ==========================================
    // RELACIONES
    // ==========================================
    
    /**
     * Tutores del alumno (muchos a muchos)
     */
    public function tutores()
    {
        return $this->belongsToMany(Tutor::class, 'alumno_tutor')
                    ->withPivot('tipo_relacion', 'es_responsable', 'vive_con_alumno')
                    ->withTimestamps();
    }

    /**
     * Tutor responsable principal
     */
    public function tutorResponsable()
    {
        return $this->belongsToMany(Tutor::class, 'alumno_tutor')
                    ->wherePivot('es_responsable', true)
                    ->withPivot('tipo_relacion', 'es_responsable', 'vive_con_alumno')
                    ->withTimestamps();
    }

    /**
     * Usuario que registró al alumno
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ==========================================
    // ACCESORES
    // ==========================================
    
    /**
     * Nombre completo del alumno
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    /**
     * Grado y grupo formateado
     */
    public function getGradoGrupoAttribute()
    {
        return $this->grado . '° ' . $this->grupo;
    }

    // ==========================================
    // SCOPES (filtros)
    // ==========================================
    
    public function scopeRegulares($query)
    {
        return $query->where('estatus', 'Regular');
    }

    public function scopeIrregulares($query)
    {
        return $query->where('estatus', 'Irregular');
    }

    public function scopePorGrupo($query, $grado, $grupo)
    {
        return $query->where('grado', $grado)->where('grupo', $grupo);
    }
// ==========================================
// MUTATORS (Capitalizar automáticamente)
// ==========================================

public function setNombreAttribute($value)
{
    $this->attributes['nombre'] = ucwords(strtolower($value));
}

public function setApellidosAttribute($value)
{
    $this->attributes['apellidos'] = ucwords(strtolower($value));
}

public function setLugarNacimientoAttribute($value)
{
    $this->attributes['lugar_nacimiento'] = $value ? ucwords(strtolower($value)) : null;
}

public function setNacionalidadAttribute($value)
{
    $this->attributes['nacionalidad'] = $value ? ucwords(strtolower($value)) : 'Mexicana';
}

public function setObservacionesAttribute($value)
{
    $this->attributes['observaciones'] = $value ? ucfirst(strtolower($value)) : null;
}

public function setAlergiasAttribute($value)
{
    $this->attributes['alergias'] = $value ? ucfirst(strtolower($value)) : null;
}

public function setEnfermedadesCronicasAttribute($value)
{
    $this->attributes['enfermedades_cronicas'] = $value ? ucfirst(strtolower($value)) : null;
}

public function setMedicamentosAttribute($value)
{
    $this->attributes['medicamentos'] = $value ? ucfirst(strtolower($value)) : null;
}

public function setContactoEmergenciaNombreAttribute($value)
{
    $this->attributes['contacto_emergencia_nombre'] = $value ? ucwords(strtolower($value)) : null;
}
    // ==========================================
    // RELACIÓN CON BITÁCORA
    // ==========================================
    public function bitacoras()
    {
        return $this->morphMany(Bitacora::class, 'entidad');
    }
}
