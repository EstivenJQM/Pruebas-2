<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('servicio_usuario', function (Blueprint $table) {
            $table->unsignedInteger('id_servicio');
            $table->unsignedInteger('id_rol_usuario');
            $table->primary(['id_servicio', 'id_rol_usuario']);
            $table->foreign('id_servicio')->references('id_servicio')->on('servicio')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_rol_usuario')->references('id_rol_usuario')->on('rol_usuario')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('servicio_usuario'); }
};