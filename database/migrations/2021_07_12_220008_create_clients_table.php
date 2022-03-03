<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /*
        clienteNombre
        clienteApellido
        clienteCelular
        clienteCiudad
        clienteDireccion
        clienteNIT
        clienteCarnet
        clienteCorreo
        clienteEstado
        586427
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('code',150)->unique();
            $table->string('name',150);
            $table->string('lastname', 150);
            $table->string('phone', 12);
            $table->string('city', 100);
            $table->string('address', 200);
            $table->string('nit', 15)->nullable();
            $table->string('ci', 15);
            $table->string('email')->unique();
            $table->boolean('statu')->default(true);
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
        Schema::dropIfExists('clients');
    }
}
