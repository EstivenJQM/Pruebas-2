<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->increments('id_rol_usuario');
            $table->unsignedInteger('id_usuario');
            $table->unsignedSmallInteger('id_sede');
            $table->enum('rol', ['ESTUDIANTE', 'EMPLEADO', 'FAMILIAR']);
            $table->unique(['id_usuario', 'id_sede', 'rol']);
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')
                  ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_sede')->references('id_sede')->on('sede')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('rol_usuario'); }
};