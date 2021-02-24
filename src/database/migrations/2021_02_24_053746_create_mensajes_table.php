<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos');
            $table->foreignId('diagrama_id')->nullable()->constrained('diagramas');
            $table->foreignId('especificacion_id')->nullable()->constrained('especificacions');
            $table->foreignId('user_id')->constrained('users');
            $table->mediumText('mensaje');
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
        Schema::dropIfExists('mensajes');
    }
}
