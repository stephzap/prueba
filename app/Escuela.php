<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Escuela extends Model
{
    	
    
    //protected $connection = 'mysql';
   // protected $primaryKey = 'id_t_calificaciones';
    protected $table = 't_calificaciones';
    protected $fillable = array(
      'id_t_materias',
       'id_t_usuarios',
      'calificacion',
       'fecha_registro');


    //public $timestamps = false;
    
    

}
