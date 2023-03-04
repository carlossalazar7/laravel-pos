<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePuntoEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_punto_entregas', function (Blueprint $table) {
            $table->id();
//            relacion a rutas
            $table->unsignedBigInteger('route_id');
            //$table->foreign('route_id')->references('id')->on('routes');
//            relacion a puntos de entregas
            $table->unsignedBigInteger('punto_entrega_id');
            //$table->foreign('punto_entrega_id')->references('id')->on('punto_entregas');
            $table->string('observacion');
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
        Schema::dropIfExists('detalle_punto_entregas');
    }
}
