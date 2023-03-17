<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('phone_number');
            $table->mediumText('address')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('nit')->nullable();
            $table->string('nrc')->nullable();
            $table->string('tipo_cliente')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->integer('customer_group')->default(1);
            $table->integer('created_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
