<?php

namespace App\Helpers;

use App\Models\Configuracion;

class ConfiguracionHelper
{
    public static function get()
    {
        return Configuracion::first();
    }

    public static function nombre()
    {
        $config = self::get();
        return $config->nombre_escuela ?? 'Escuela Primaria';
    }

    public static function clave()
    {
        $config = self::get();
        return $config->clave_centro_trabajo ?? '______';
    }

    public static function zona()
    {
        $config = self::get();
        return $config->zona_escolar ?? '___';
    }

    public static function sector()
    {
        $config = self::get();
        return $config->sector_educativo ?? '___';
    }

    public static function direccion()
    {
        $config = self::get();
        return $config->direccion ?? 'Dirección de la escuela';
    }

    public static function lema()
    {
        $config = self::get();
        return $config->lema ?? 'Educación para el futuro';
    }

    public static function logo()
    {
        $config = self::get();
        return $config->logo ?? 'assets/img/logo.png';
    }

    public static function director()
    {
        $config = self::get();
        return $config->director_nombre ?? 'Director(a) de la Escuela';
    }
}