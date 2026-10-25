<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
   /**
    *Campos que se pueden llenar masivamente
    */
	protected $fillable =[

	'nombre',
	'apellidos',
	'curp',
	'grado',
	'grupo',
       ];
}
