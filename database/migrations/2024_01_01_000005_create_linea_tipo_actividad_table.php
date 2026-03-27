<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('linea_tipo_actividad', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_linea');
            $table->unsignedSmallInteger('id_tipo_actividad');
            $table->primary(['id_linea', 'id_tipo_actividad']);
            $table->foreign('id_linea')->references('id_linea')->on('linea')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tipo_actividad')->references('id_tipo_actividad')->on('tipo_actividad')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('linea_tipo_actividad'); }
};