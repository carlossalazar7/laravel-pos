<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status', 50)->default('open');
            $table->integer('created_by');
            $table->date('fecha_entrega');
            $table->string('observacion')->nullable();
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('route_id');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->foreign('route_id')->references('id')->on('routes');
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
        Schema::dropIfExists('guides');
    }
}
