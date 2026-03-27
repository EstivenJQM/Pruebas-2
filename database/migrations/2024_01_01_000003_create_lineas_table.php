<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('linea', function (Blueprint $table) {
            $table->smallIncrements('id_linea');
            $table->string('nombre', 120);
            $table->unsignedSmallInteger('id_componente');
            $table->foreign('id_componente')->references('id_componente')->on('componente')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('linea'); }
};