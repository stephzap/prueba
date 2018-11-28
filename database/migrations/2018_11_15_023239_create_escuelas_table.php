<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('t_materias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->Increments('id_t_materias');
            $table->string('nombre',80);
            $table->integer('activo');
            $table->longText('pass');
            $table->timestamps();

     
            
        });

            Schema::create('t_alumnos', function (Blueprint $table) {
            $table->engine = 'InnoDB';    
            $table->Increments('id_t_usuarios');
            $table->string('nombre',80);
            $table->string('ap_paterno',80);
            $table->string('ap_materno',80);
            $table->integer('a_activo');
            $table->timestamps();
            
        });


               Schema::create('t_calificaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';    
            $table->Increments('id_t_calificaciones');
            $table->unsignedInteger('id_t_materias');
            $table->unsignedInteger('id_t_usuarios');
            $table->decimal('calificacion',10,2);
            $table->date('fecha_registro');
            $table->foreign('id_t_materias')->references('id_t_calificaciones')->on('t_calificacines');
            $table->foreign('id_t_usuarios')->references('id_t_calificaciones')->on('t_calificacines');
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('t_materias');
          Schema::dropIfExists('t_alumnos');
           Schema::dropIfExists('t_calificacines');

    }
}
