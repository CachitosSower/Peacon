<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_costo');
            $table->string('nombre');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->boolean('es_proveedor');
            $table->integer('descuento_porcentual');
            $table->integer('descuento_bruto');
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
        Schema::drop('itemes');
    }
}
