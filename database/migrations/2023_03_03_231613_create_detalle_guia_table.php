<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleGuiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_guia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('guide_id');
            $table->unsignedBigInteger('order_id');

            //$table->foreign('guide_id')->references('id')->on('guides');
            //$table->foreign('order_id')->references('id')->on('orders');

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
        Schema::dropIfExists('detalle_guia');
    }
}
