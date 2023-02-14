<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto');
            $table->string('descripcion');
            $table->double('unidad_medida');
            $table->double('precio_lista');
            $table->string('imagen');
            $table->integer('estatus_activo');
            $table->integer('estatus_borrado');
            $table->unsignedBigInteger('submenu_id');
            $table->timestamps();

            $table->foreign('submenu_id')->references('id')->on('submenus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
