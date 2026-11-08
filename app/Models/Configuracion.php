<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';

    protected $fillable = [
        // Datos de la escuela
        'nombre_escuela',
        'clave_centro_trabajo',
        'zona_escolar',
        'sector_educativo',
        'direccion',
        'telefono',
        'email',
        'logo',
        'lema',
        
        // Autoridades
        'director_nombre',
        'director_cedula',
        'supervisor_nombre',
        'jefe_sector_nombre',
        'crede_oficina',
        
        // Ciclo escolar
        'ciclo_actual',
        'ciclo_inicio',
        'ciclo_fin',
        
        // Configuración
        'formato_fecha',
        'moneda',
        
        // Remitente
        'remitente_nombre',
        'remitente_cargo',
        
        // Firmas y sellos
        'firma_director',
        'sello_escuela',
    ];

    /**
     * Obtener la configuración (siempre la primera fila)
     */
    public static function getConfig()
    {
        return self::first();
    }

    /**
     * Generar el ciclo escolar automáticamente
     */
    public static function generarCicloEscolar()
    {
        $config = self::getConfig();
        
        if (!$config || !$config->ciclo_inicio || !$config->ciclo_fin) {
            return date('Y') . '-' . (date('Y') + 1);
        }

        $anioInicio = date('Y', strtotime($config->ciclo_inicio));
        $anioFin = date('Y', strtotime($config->ciclo_fin));
        
        return $anioInicio . '-' . $anioFin;
    }
}
