<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_trabajo');
            $table->integer('id_costo');
            $table->string('nombre');
            $table->string('correo')->nullable();
            $table->integer('telefono')->nullable();
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->text('comentario')->nullable();
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
        Schema::drop('cotizaciones');
    }
}
