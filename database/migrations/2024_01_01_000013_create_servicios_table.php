<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('servicio', function (Blueprint $table) {
            $table->increments('id_servicio');
            $table->string('nombre', 200);
            $table->unsignedSmallInteger('id_linea');
            $table->unsignedSmallInteger('id_tipo_actividad');
            $table->unsignedSmallInteger('id_sede');
            $table->date('fecha');
            $table->index('fecha');
            $table->foreign('id_linea')->references('id_linea')->on('linea')
                  ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_tipo_actividad')->references('id_tipo_actividad')->on('tipo_actividad')
                  ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_sede')->references('id_sede')->on('sede')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('servicio'); }
};